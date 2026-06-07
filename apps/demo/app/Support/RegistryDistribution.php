<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Turns the authored Blade components, blocks and charts into a public,
 * shadcn-compatible distribution layer.
 *
 * Two shapes are produced:
 *  - index()        → the registry schema (https://ui.shadcn.com/schema/registry.json):
 *                     a catalogue of items WITHOUT file bodies.
 *  - *Item()        → the registry-item schema (.../registry-item.json):
 *                     a single item WITH every file's contents inlined and a
 *                     `target` path, so ANY tool — the official shadcn CLI/MCP,
 *                     the BlatUI CLI, or a raw `curl` — can write the files.
 *
 * The same endpoints back llms.txt (AI discoverability). Everything is derived
 * from disk on demand; callers are expected to cache on signature().
 */
class RegistryDistribution
{
    public function __construct(
        protected BlatuiRegistry $components,
    ) {}

    protected function blocksDir(): string
    {
        return resource_path('views/blocks');
    }

    protected function chartsDir(): string
    {
        return resource_path('views/charts');
    }

    /** Absolute base URL of the registry (e.g. https://blatui.remix-it.com). */
    public function baseUrl(): string
    {
        return rtrim(config('app.url', 'https://blatui.remix-it.com'), '/');
    }

    // ---------------------------------------------------------------------
    // Registry index (catalogue, no file bodies)
    // ---------------------------------------------------------------------

    public function index(): array
    {
        $items = [];

        foreach (array_keys($this->components->families()) as $family) {
            $items[] = $this->componentMeta($family);
        }
        foreach ($this->blockNames() as $name) {
            $items[] = $this->blockMeta($name);
        }
        foreach ($this->chartNames() as $name) {
            $items[] = $this->chartMeta($name);
        }

        return [
            '$schema' => 'https://ui.shadcn.com/schema/registry.json',
            'name' => 'blatui',
            'homepage' => $this->baseUrl(),
            'items' => $items,
        ];
    }

    // ---------------------------------------------------------------------
    // Component items
    // ---------------------------------------------------------------------

    /** Catalogue entry for a component family (no file contents). */
    protected function componentMeta(string $family): array
    {
        $files = array_map(
            fn (string $path) => [
                'path' => 'ui/'.basename($path),
                'type' => 'registry:file',
                'target' => 'resources/views/components/ui/'.basename($path),
            ],
            $this->components->filesFor($family),
        );

        $packages = $this->components->packagesFor($family);

        return array_filter([
            'name' => $family,
            'type' => 'registry:ui',
            'title' => $this->title($family),
            'description' => $this->description($family),
            'files' => $files,
            'registryDependencies' => $this->components->dependenciesFor($family),
            'dependencies' => $packages['npm'] ?? [],
            'categories' => array_values(array_filter([$this->categoryOf($family)])),
        ], fn ($v) => $v !== null && $v !== []);
    }

    /** Full installable item for a component family (file contents inlined). */
    public function componentItem(string $family): ?array
    {
        if (! $this->components->familyExists($family)) {
            return null;
        }

        $files = [];
        foreach ($this->components->filesFor($family) as $path) {
            $target = 'resources/views/components/ui/'.basename($path);
            $files[] = [
                'path' => $target,
                'content' => is_file($path) ? (string) file_get_contents($path) : '',
                'type' => 'registry:file',
                'target' => $target,
            ];
        }

        $packages = $this->components->packagesFor($family);

        return array_filter([
            '$schema' => 'https://ui.shadcn.com/schema/registry-item.json',
            'name' => $family,
            'type' => 'registry:ui',
            'title' => $this->title($family),
            'description' => $this->description($family),
            'author' => 'BlatUI (https://blatui.remix-it.com)',
            'registryDependencies' => $this->components->dependenciesFor($family),
            'dependencies' => $packages['npm'] ?? [],
            'files' => $files,
            'docs' => $this->installDocs($packages),
            'meta' => array_filter([
                'composer' => $packages['composer'] ?? [],
                'npm' => $packages['npm'] ?? [],
                'artisan' => 'php artisan blatui:add '.$family,
            ]),
        ], fn ($v) => $v !== null && $v !== []);
    }

    // ---------------------------------------------------------------------
    // Block + chart items (full-page Blade examples)
    // ---------------------------------------------------------------------

    protected function blockMeta(string $name): array
    {
        return [
            'name' => $name,
            'type' => 'registry:block',
            'title' => $this->title($name),
            'files' => [[
                'path' => 'blocks/'.$name.'.blade.php',
                'type' => 'registry:file',
                'target' => 'resources/views/blocks/'.$name.'.blade.php',
            ]],
            'registryDependencies' => $this->dependenciesInFile($this->blocksDir().'/'.$name.'.blade.php'),
            'categories' => [Str::before($name, '-') ?: $name],
        ];
    }

    public function blockItem(string $name): ?array
    {
        return $this->fileItem($this->blocksDir(), $name, 'registry:block', 'resources/views/blocks/');
    }

    protected function chartMeta(string $name): array
    {
        return [
            'name' => $name,
            'type' => 'registry:block',
            'title' => $this->title($name),
            'files' => [[
                'path' => 'charts/'.$name.'.blade.php',
                'type' => 'registry:file',
                'target' => 'resources/views/charts/'.$name.'.blade.php',
            ]],
            'registryDependencies' => $this->dependenciesInFile($this->chartsDir().'/'.$name.'.blade.php'),
            'categories' => ['chart'],
        ];
    }

    public function chartItem(string $name): ?array
    {
        return $this->fileItem($this->chartsDir(), $name, 'registry:block', 'resources/views/charts/');
    }

    /** Shared builder for a single-file block/chart item with contents inlined. */
    protected function fileItem(string $dir, string $name, string $type, string $targetDir): ?array
    {
        $path = $dir.'/'.$name.'.blade.php';
        if (! is_file($path) || ! preg_match('/^[a-z0-9-]+$/', $name)) {
            return null;
        }

        $target = $targetDir.$name.'.blade.php';
        $deps = $this->dependenciesInFile($path);

        // Roll up the npm/composer packages of every component this example uses.
        $composer = [];
        $npm = [];
        foreach ($deps as $family) {
            $pkgs = $this->components->packagesFor($family);
            $composer = array_merge($composer, $pkgs['composer'] ?? []);
            $npm = array_merge($npm, $pkgs['npm'] ?? []);
        }
        $packages = array_filter([
            'composer' => array_values(array_unique($composer)),
            'npm' => array_values(array_unique($npm)),
        ]);

        return array_filter([
            '$schema' => 'https://ui.shadcn.com/schema/registry-item.json',
            'name' => $name,
            'type' => $type,
            'title' => $this->title($name),
            'author' => 'BlatUI (https://blatui.remix-it.com)',
            'registryDependencies' => $deps,
            'dependencies' => $packages['npm'] ?? [],
            'files' => [[
                'path' => $target,
                'content' => (string) file_get_contents($path),
                'type' => 'registry:file',
                'target' => $target,
            ]],
            'docs' => $this->installDocs($packages),
            'meta' => $packages,
        ], fn ($v) => $v !== null && $v !== []);
    }

    // ---------------------------------------------------------------------
    // llms.txt — AI discoverability
    // ---------------------------------------------------------------------

    /** Concise index: one line per item, grouped, with install commands. */
    public function llms(): string
    {
        $base = $this->baseUrl();
        $out = [];
        $out[] = '# BlatUI';
        $out[] = '';
        $out[] = '> shadcn/ui for the BLAT stack — Blade, Laravel, Alpine.js, Tailwind CSS v4. '
            .'Open-source (MIT), copy-paste, accessible (WCAG AA) UI components you own. '
            .'No JS runtime lock-in. Works with or without Livewire.';
        $out[] = '';
        $out[] = 'Install the CLI: `composer require blatui/blatui`, then `php artisan blatui:add <component>`.';
        $out[] = 'Every component, block and chart is also installable from this registry: '
            .'`'.$base.'/r/<name>.json` (shadcn registry-item schema).';
        $out[] = '';

        foreach (config('docs.categories', []) as $label => $slugs) {
            $out[] = '## '.$label;
            $out[] = '';
            foreach ($slugs as $slug) {
                if (! $this->components->familyExists($slug)) {
                    continue;
                }
                $desc = $this->description($slug);
                $out[] = '- ['.$this->title($slug).']('.$base.'/components/'.$slug.')'
                    .($desc ? ': '.$desc : '').' — `php artisan blatui:add '.$slug.'`';
            }
            $out[] = '';
        }

        $out[] = '## Blocks';
        $out[] = '';
        $out[] = count($this->blockNames()).' full-page examples (dashboards, auth, calendars, sidebars…). '
            .'Browse: '.$base.'/blocks · install: `'.$base.'/r/blocks/<name>.json`.';
        $out[] = '';
        $out[] = '## Charts';
        $out[] = '';
        $out[] = count($this->chartNames()).' ApexCharts examples. '
            .'Browse: '.$base.'/charts · install: `'.$base.'/r/charts/<name>.json`.';
        $out[] = '';

        return implode("\n", $out)."\n";
    }

    /** Full text: every component with description, files and install commands. */
    public function llmsFull(): string
    {
        $base = $this->baseUrl();
        $out = [];
        $out[] = $this->llms();
        $out[] = '---';
        $out[] = '';
        $out[] = '# Component reference';
        $out[] = '';

        foreach (config('docs.categories', []) as $label => $slugs) {
            foreach ($slugs as $slug) {
                if (! $this->components->familyExists($slug)) {
                    continue;
                }
                $packages = $this->components->packagesFor($slug);
                $out[] = '## '.$this->title($slug);
                if ($desc = $this->description($slug)) {
                    $out[] = '';
                    $out[] = $desc;
                }
                $out[] = '';
                $out[] = '- Category: '.$label;
                $out[] = '- Install: `php artisan blatui:add '.$slug.'`';
                $out[] = '- Registry: '.$base.'/r/'.$slug.'.json';
                $out[] = '- Docs: '.$base.'/components/'.$slug;
                $files = array_map('basename', $this->components->filesFor($slug));
                $out[] = '- Files: '.implode(', ', $files);
                if ($deps = $this->components->dependenciesFor($slug)) {
                    $out[] = '- Depends on: '.implode(', ', $deps);
                }
                if ($composer = $packages['composer'] ?? []) {
                    $out[] = '- Composer: '.implode(', ', $composer);
                }
                if ($npm = $packages['npm'] ?? []) {
                    $out[] = '- npm: '.implode(', ', $npm);
                }
                $out[] = '';
            }
        }

        return implode("\n", $out)."\n";
    }

    // ---------------------------------------------------------------------
    // Per-item markdown (content negotiation: GET /components/button.md, etc.)
    // ---------------------------------------------------------------------

    public function componentMarkdown(string $family): ?string
    {
        $item = $this->componentItem($family);

        return $item ? $this->renderMarkdown($item, 'php artisan blatui:add '.$family) : null;
    }

    public function blockMarkdown(string $name): ?string
    {
        $item = $this->blockItem($name);

        return $item ? $this->renderMarkdown($item) : null;
    }

    public function chartMarkdown(string $name): ?string
    {
        $item = $this->chartItem($name);

        return $item ? $this->renderMarkdown($item) : null;
    }

    /** Render a registry item (with inlined files) as agent-friendly markdown. */
    protected function renderMarkdown(array $item, ?string $install = null): string
    {
        $out = ['# '.($item['title'] ?? $item['name'])];
        if (! empty($item['description'])) {
            $out[] = '';
            $out[] = $item['description'];
        }
        $out[] = '';
        if ($install ??= ($item['registryDependencies'] ?? [] ? 'php artisan blatui:add '.implode(' ', $item['registryDependencies']) : null)) {
            $out[] = '- Install: `'.$install.'`';
        }
        $out[] = '- Source: '.$this->baseUrl().'/r/'.$item['name'].'.json';
        if ($composer = $item['meta']['composer'] ?? []) {
            $out[] = '- Composer: `composer require '.implode(' ', $composer).'`';
        }
        if ($npm = $item['meta']['npm'] ?? []) {
            $out[] = '- npm: `npm install -D '.implode(' ', $npm).'`';
        }
        $out[] = '';

        foreach ($item['files'] ?? [] as $file) {
            $out[] = '## '.($file['target'] ?? 'file');
            $out[] = '';
            $out[] = '```blade';
            $out[] = rtrim((string) ($file['content'] ?? ''));
            $out[] = '```';
            $out[] = '';
        }

        return rtrim(implode("\n", $out))."\n";
    }

    // ---------------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------------

    public function blockNames(): array
    {
        return $this->bladeNamesIn($this->blocksDir());
    }

    public function chartNames(): array
    {
        return $this->bladeNamesIn($this->chartsDir());
    }

    protected function bladeNamesIn(string $dir): array
    {
        return collect(glob($dir.'/*.blade.php') ?: [])
            ->map(fn ($f) => basename($f, '.blade.php'))
            ->reject(fn ($n) => $n === 'index')
            ->sort()
            ->values()
            ->all();
    }

    /** Component families referenced via <x-ui.X ...> inside a file. */
    protected function dependenciesInFile(string $path): array
    {
        if (! is_file($path)) {
            return [];
        }

        preg_match_all('/<x-ui\.([a-z0-9-]+)/i', (string) file_get_contents($path), $m);

        return collect($m[1] ?? [])
            ->map(fn ($slug) => $this->components->familyOf($slug) ?? $slug)
            ->filter(fn ($fam) => $this->components->familyExists($fam))
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    protected function title(string $slug): string
    {
        return config('docs.labels.'.$slug) ?? Str::headline($slug);
    }

    protected function description(string $slug): ?string
    {
        return config('docs.descriptions.'.$slug);
    }

    protected function categoryOf(string $slug): ?string
    {
        foreach (config('docs.categories', []) as $label => $slugs) {
            if (in_array($slug, $slugs, true)) {
                return Str::slug($label);
            }
        }

        return null;
    }

    protected function installDocs(array $packages): ?string
    {
        $lines = [];
        if ($composer = $packages['composer'] ?? []) {
            $lines[] = 'composer require '.implode(' ', $composer);
        }
        if ($npm = $packages['npm'] ?? []) {
            $lines[] = 'npm install -D '.implode(' ', $npm);
        }

        return $lines ? implode("\n", $lines) : null;
    }

    /**
     * Cheap content signature (max mtime across every source dir + docs config),
     * so callers can cache generated payloads and bust automatically on edits.
     */
    public function signature(): string
    {
        $paths = array_merge(
            glob($this->components->sourceDir().'/*.blade.php') ?: [],
            glob($this->blocksDir().'/*.blade.php') ?: [],
            glob($this->chartsDir().'/*.blade.php') ?: [],
            [config_path('docs.php')],
        );

        $latest = 0;
        $count = count($paths);
        foreach ($paths as $p) {
            $latest = max($latest, is_file($p) ? (int) filemtime($p) : 0);
        }

        return substr(md5($count.':'.$latest), 0, 12);
    }
}
