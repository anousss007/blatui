<?php

namespace BlatUI\Mcp;

use BlatUI\Registry;

/**
 * Data source for the MCP server.
 *
 * Prefers the live registry at blatui.remix-it.com (richest: titles,
 * descriptions, blocks and charts, always current) and falls back to the
 * component stubs bundled inside this package when the network is unavailable
 * — so `get_component` keeps working fully offline. No HTTP client dependency:
 * a tiny stream-context fetch keeps the package black-box-free.
 */
class RegistryClient
{
    public const DEFAULT_BASE = 'https://blatui.remix-it.com';

    protected string $base;

    /** @var array<string, mixed>|null In-process cache of the registry index. */
    protected ?array $indexCache = null;

    public function __construct(
        protected Registry $registry,
        ?string $base = null,
    ) {
        $this->base = rtrim($base ?: (getenv('BLATUI_REGISTRY_URL') ?: self::DEFAULT_BASE), '/');
    }

    public function base(): string
    {
        return $this->base;
    }

    // ---------------------------------------------------------------------
    // Catalogue
    // ---------------------------------------------------------------------

    /**
     * Every registry item as {name, type, title, description, categories}.
     * Remote first; falls back to the locally bundled component manifest.
     *
     * @return list<array<string, mixed>>
     */
    public function index(): array
    {
        if ($this->indexCache !== null) {
            return $this->indexCache;
        }

        $remote = $this->httpGetJson($this->base.'/registry.json');
        if (is_array($remote) && isset($remote['items']) && is_array($remote['items'])) {
            return $this->indexCache = array_values($remote['items']);
        }

        // Offline fallback: components only, from the bundled manifest.
        $items = [];
        foreach (array_keys($this->registry->families()) as $family) {
            $items[] = [
                'name' => $family,
                'type' => 'registry:ui',
                'title' => ucwords(str_replace('-', ' ', $family)),
                'registryDependencies' => $this->registry->dependenciesFor($family),
            ];
        }

        return $this->indexCache = $items;
    }

    /** Index entries narrowed to a registry type (registry:ui, registry:block…). */
    public function itemsOfType(string $type): array
    {
        return array_values(array_filter($this->index(), fn ($i) => ($i['type'] ?? null) === $type));
    }

    /** Free-text search across name, title and description. */
    public function search(string $query, ?string $type = null): array
    {
        $query = trim(mb_strtolower($query));

        return array_values(array_filter($this->index(), function ($item) use ($query, $type) {
            if ($type !== null && ($item['type'] ?? null) !== $type) {
                return false;
            }
            if ($query === '') {
                return true;
            }
            $haystack = mb_strtolower(implode(' ', [
                $item['name'] ?? '',
                $item['title'] ?? '',
                $item['description'] ?? '',
                implode(' ', $item['categories'] ?? []),
            ]));

            return str_contains($haystack, $query);
        }));
    }

    // ---------------------------------------------------------------------
    // Single items (with source)
    // ---------------------------------------------------------------------

    /**
     * A component family with its Blade source inlined. Reads the bundled
     * stubs first (offline, authoritative for source); enriches metadata from
     * the remote item when reachable.
     */
    public function component(string $name): ?array
    {
        if ($this->registry->familyExists($name)) {
            $targetDir = $this->registry->targetFor($name);   // resources/views/components/{ui,block}
            $files = [];
            foreach ($this->registry->filesFor($name) as $path) {
                $files[] = [
                    'target' => $targetDir.'/'.basename($path),
                    'content' => is_file($path) ? (string) file_get_contents($path) : '',
                ];
            }

            $packages = $this->registry->packagesFor($name);
            $meta = $this->indexEntry($name);

            return [
                'name' => $name,
                'type' => 'registry:ui',
                'title' => $meta['title'] ?? ucwords(str_replace('-', ' ', $name)),
                'description' => $meta['description'] ?? null,
                'files' => $files,
                'registryDependencies' => $this->registry->dependenciesFor($name),
                'composer' => $packages['composer'] ?? [],
                'npm' => $packages['npm'] ?? [],
                'install' => 'php artisan blatui:add '.$name,
            ];
        }

        // Not bundled locally — try the remote item endpoint.
        return $this->normalizeRemoteItem($this->httpGetJson($this->base.'/r/'.$name.'.json'));
    }

    /** A block or chart example (remote only — not bundled in the package). */
    public function example(string $kind, string $name): ?array
    {
        $segment = $kind === 'chart' ? 'charts' : 'blocks';

        return $this->normalizeRemoteItem($this->httpGetJson($this->base.'/r/'.$segment.'/'.$name.'.json'));
    }

    // ---------------------------------------------------------------------
    // Internals
    // ---------------------------------------------------------------------

    protected function indexEntry(string $name): ?array
    {
        foreach ($this->index() as $item) {
            if (($item['name'] ?? null) === $name) {
                return $item;
            }
        }

        return null;
    }

    /** Flatten a remote registry-item into the shape the MCP tools emit. */
    protected function normalizeRemoteItem(?array $item): ?array
    {
        if (! is_array($item) || ! isset($item['name'])) {
            return null;
        }

        $files = array_map(fn ($f) => [
            'target' => $f['target'] ?? $f['path'] ?? '',
            'content' => $f['content'] ?? '',
        ], $item['files'] ?? []);

        return [
            'name' => $item['name'],
            'type' => $item['type'] ?? 'registry:file',
            'title' => $item['title'] ?? ucwords(str_replace('-', ' ', $item['name'])),
            'description' => $item['description'] ?? null,
            'files' => $files,
            'registryDependencies' => $item['registryDependencies'] ?? [],
            'composer' => $item['meta']['composer'] ?? [],
            'npm' => $item['meta']['npm'] ?? $item['dependencies'] ?? [],
        ];
    }

    /** Minimal dependency-free JSON GET. Returns null on any failure. */
    protected function httpGetJson(string $url): ?array
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'timeout' => 6,
                'ignore_errors' => true,
                'header' => "User-Agent: blatui-mcp\r\nAccept: application/json\r\n",
            ],
            'https' => [
                'method' => 'GET',
                'timeout' => 6,
                'ignore_errors' => true,
                'header' => "User-Agent: blatui-mcp\r\nAccept: application/json\r\n",
            ],
        ]);

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
