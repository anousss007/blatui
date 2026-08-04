<?php

namespace BlatUI;

/**
 * Installs registry items from a remote, shadcn-compatible registry — turning
 * `blatui:add` into a platform: anyone can publish components by serving a
 * registry-item JSON, and consumers add them by namespace or URL:
 *
 *   php artisan blatui:add @acme/fancy-button
 *   php artisan blatui:add https://acme.test/r/fancy-button.json
 *
 * Namespaces resolve through config('blatui.registries'); the built-in
 * `@blatui` points at the official registry. Files are written to each item's
 * `target` path and `registryDependencies` are resolved recursively (preferring
 * the locally bundled stubs when a dependency ships with this package).
 */
class RemoteInstaller
{
    /** @var array<string, string> namespace => URL template containing {name} */
    protected array $registries;

    /** @var callable(string):?string */
    protected $fetcher;

    /**
     * @param  array<string, string>  $registries
     * @param  (callable(string):?string)|null  $fetcher  Override the HTTP layer (tests).
     */
    public function __construct(
        protected Registry $local,
        array $registries = [],
        ?callable $fetcher = null,
    ) {
        $this->registries = array_merge(
            ['@blatui' => 'https://blatui.remix-it.com/r/{name}.json'],
            $registries,
        );
        $this->fetcher = $fetcher ?? fn (string $url) => $this->httpGet($url);
    }

    /** A spec is "remote" when it is a URL or a namespaced name. */
    public static function isRemote(string $spec): bool
    {
        return str_contains($spec, '://') || str_starts_with($spec, '@') || str_contains($spec, '/');
    }

    /**
     * Resolve a spec to an absolute registry-item URL, or null if its namespace
     * is unknown.
     */
    public function resolveUrl(string $spec): ?string
    {
        if (str_contains($spec, '://')) {
            return $spec;
        }

        // @namespace/name  → template lookup
        if (str_starts_with($spec, '@') && str_contains($spec, '/')) {
            [$ns, $name] = explode('/', $spec, 2);
            $template = $this->registries[$ns] ?? null;

            return $template ? str_replace('{name}', $name, $template) : null;
        }

        // vendor/name without @ → treat the first segment as the namespace key.
        if (str_contains($spec, '/')) {
            [$ns, $name] = explode('/', $spec, 2);
            $template = $this->registries['@'.$ns] ?? $this->registries[$ns] ?? null;

            return $template ? str_replace('{name}', $name, $template) : null;
        }

        return null;
    }

    /**
     * Fetch + write a remote item and all its dependencies.
     *
     * @return array{written: list<string>, skipped: list<string>, errors: list<string>, composer: list<string>, npm: list<string>}
     */
    public function install(string $spec, string $basePath, bool $force = false): array
    {
        $state = ['written' => [], 'skipped' => [], 'errors' => [], 'composer' => [], 'npm' => [], 'seen' => []];
        $this->installItem($spec, $basePath, $force, $state);
        unset($state['seen']);

        return $state;
    }

    protected function installItem(string $spec, string $basePath, bool $force, array &$state): void
    {
        if (in_array($spec, $state['seen'], true)) {
            return;
        }
        $state['seen'][] = $spec;

        // A bare dependency that ships locally? Defer to the bundled stub.
        if (! self::isRemote($spec) && $this->local->familyExists($spec)) {
            $this->installLocalFamily($spec, $basePath, $force, $state);

            return;
        }

        $url = $this->resolveUrl($spec);
        if ($url === null) {
            $state['errors'][] = "Unknown registry for \"{$spec}\" (configure config/blatui.php → registries).";

            return;
        }

        $item = ($this->fetcher)($url);
        if (! is_array($item) || empty($item['files'])) {
            $state['errors'][] = "Could not fetch a valid registry item from {$url}.";

            return;
        }

        foreach ($item['files'] as $file) {
            $target = $file['target'] ?? $file['path'] ?? null;
            if (! $target || ! array_key_exists('content', $file)) {
                continue;
            }
            $this->writeFile($basePath.'/'.ltrim($target, '/'), (string) $file['content'], $force, $state);
        }

        $state['composer'] = array_values(array_unique(array_merge($state['composer'], $item['meta']['composer'] ?? [])));
        $state['npm'] = array_values(array_unique(array_merge($state['npm'], $item['meta']['npm'] ?? $item['dependencies'] ?? [])));

        // Resolve component dependencies against the SAME registry namespace.
        $ns = str_starts_with($spec, '@') && str_contains($spec, '/') ? explode('/', $spec, 2)[0] : null;
        foreach ($item['registryDependencies'] ?? [] as $dep) {
            $depSpec = (str_contains($dep, '://') || str_starts_with($dep, '@') || $ns === null)
                ? $dep
                : $ns.'/'.$dep;
            $this->installItem($depSpec, $basePath, $force, $state);
        }
    }

    protected function installLocalFamily(string $family, string $basePath, bool $force, array &$state): void
    {
        // Each family carries its own namespace dir (ui → components/ui, block →
        // components/block); hardcoding ui here would drop <x-block.*> pieces
        // pulled in as a remote dependency into the wrong namespace.
        $dest = $basePath.'/'.trim($this->local->targetFor($family), '/');
        foreach ($this->local->filesFor($family) as $src) {
            $this->writeFile($dest.'/'.basename($src), is_file($src) ? (string) file_get_contents($src) : '', $force, $state);
        }
        $packages = $this->local->packagesFor($family);
        $state['composer'] = array_values(array_unique(array_merge($state['composer'], $packages['composer'] ?? [])));
        $state['npm'] = array_values(array_unique(array_merge($state['npm'], $packages['npm'] ?? [])));

        foreach ($this->local->dependenciesFor($family) as $dep) {
            $this->installItem($dep, $basePath, $force, $state);
        }
    }

    protected function writeFile(string $path, string $content, bool $force, array &$state): void
    {
        if (is_file($path) && ! $force) {
            $state['skipped'][] = $path;

            return;
        }
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($path, $content);
        $state['written'][] = $path;
    }

    protected function httpGet(string $url): ?array
    {
        $context = stream_context_create(['http' => [
            'method' => 'GET',
            'timeout' => 8,
            'ignore_errors' => true,
            'header' => "User-Agent: blatui-cli\r\nAccept: application/json\r\n",
        ]]);

        try {
            $body = @file_get_contents($url, false, $context);
        } catch (\Throwable) {
            return null;
        }

        if ($body === false || $body === '') {
            return null;
        }

        $decoded = json_decode($body, true);

        return is_array($decoded) ? $decoded : null;
    }
}
