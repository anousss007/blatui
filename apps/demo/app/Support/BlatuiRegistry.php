<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Discovers Blatui component "families" from the authored Blade components
 * and resolves their inter-component + package dependencies. This powers the
 * copy-paste distribution model (shadcn-style): `blatui:add <component>`
 * copies a family and everything it needs into the consuming project.
 */
class BlatuiRegistry
{
    /**
     * Curated family roots. A component slug belongs to the LONGEST root that
     * is a prefix of it (so `alert-dialog-*` → "alert-dialog", not "alert";
     * `input-otp-slot` → "input-otp", not "input").
     */
    public const ROOTS = [
        'accordion', 'alert-dialog', 'alert', 'aspect-ratio', 'avatar', 'badge',
        'breadcrumb', 'button-group', 'button', 'calendar', 'card', 'carousel',
        'chart', 'checkbox', 'collapsible', 'combobox', 'command-dialog', 'command',
        'context-menu', 'datetime-picker', 'date-picker', 'dialog', 'drawer', 'dropdown-menu', 'empty',
        'field', 'hover-card', 'input-otp', 'input-group', 'input', 'item', 'kbd',
        'label', 'menubar', 'navigation-menu', 'pagination', 'popover', 'progress',
        'radio-group', 'resizable', 'scroll-area', 'select', 'separator', 'sheet',
        'sidebar', 'skeleton', 'slider', 'sonner', 'sparkline', 'spinner', 'switch', 'table',
        'tabs', 'terminal', 'textarea', 'time-field', 'timeline', 'toggle-group', 'toggle', 'tooltip',
        'countdown',
    ];

    public function __construct(
        protected string $sourceDir = '',
    ) {
        if ($this->sourceDir === '') {
            $this->sourceDir = resource_path('views/components/ui');
        }
    }

    /** @var list<string>|null */
    protected ?array $rootsCache = null;

    /** @var list<string>|null */
    protected ?array $slugsCache = null;

    /** @var array<string, list<string>>|null */
    protected ?array $familiesCache = null;

    /** Roots ordered longest-first so prefix matching is unambiguous. */
    protected function rootsByLength(): array
    {
        if ($this->rootsCache !== null) {
            return $this->rootsCache;
        }

        $roots = self::ROOTS;
        usort($roots, fn ($a, $b) => strlen($b) <=> strlen($a));

        return $this->rootsCache = $roots;
    }

    /** Map a component slug to its family root. */
    public function familyOf(string $slug): ?string
    {
        foreach ($this->rootsByLength() as $root) {
            if ($slug === $root || str_starts_with($slug, $root.'-')) {
                return $root;
            }
        }

        return null;
    }

    /** All slugs present in the source directory (memoized per instance). */
    public function slugs(): array
    {
        if ($this->slugsCache !== null) {
            return $this->slugsCache;
        }

        $files = glob($this->sourceDir.'/*.blade.php') ?: [];

        return $this->slugsCache = collect($files)
            ->map(fn ($f) => Str::beforeLast(basename($f), '.blade.php'))
            ->sort()
            ->values()
            ->all();
    }

    /**
     * Group every slug into its family => [slugs...].
     *
     * Memoized: this is called hundreds of times while resolving block/chart
     * dependencies, and re-globbing the directory each time made building the
     * full registry index O(n²) — fast on SSD, but enough to blow PHP's
     * max_execution_time on a slower disk.
     */
    public function families(): array
    {
        if ($this->familiesCache !== null) {
            return $this->familiesCache;
        }

        $families = [];

        foreach ($this->slugs() as $slug) {
            $family = $this->familyOf($slug) ?? $slug;
            $families[$family][] = $slug;
        }

        ksort($families);

        return $this->familiesCache = $families;
    }

    public function familyExists(string $family): bool
    {
        return array_key_exists($family, $this->families());
    }

    /** Absolute file paths that make up a family. */
    public function filesFor(string $family): array
    {
        $slugs = $this->families()[$family] ?? [];

        return array_map(fn ($s) => $this->sourceDir.'/'.$s.'.blade.php', $slugs);
    }

    /** @var array<string, string> */
    protected array $sourceCache = [];

    /** Concatenated source of a family (memoized — read once, scanned twice). */
    protected function sourceFor(string $family): string
    {
        return $this->sourceCache[$family] ??= collect($this->filesFor($family))
            ->map(fn ($p) => is_file($p) ? file_get_contents($p) : '')
            ->implode("\n");
    }

    /**
     * Other component families this family references via <x-ui.X ...>,
     * excluding self-references and its own sub-components.
     */
    public function dependenciesFor(string $family): array
    {
        $source = $this->sourceFor($family);
        $own = $this->families()[$family] ?? [];

        preg_match_all('/<x-ui\.([a-z0-9-]+)/i', $source, $matches);

        return collect($matches[1] ?? [])
            ->reject(fn ($slug) => in_array($slug, $own, true))
            ->map(fn ($slug) => $this->familyOf($slug) ?? $slug)
            ->reject(fn ($fam) => $fam === $family)
            ->unique()
            ->sort()
            ->values()
            ->all();
    }

    /** Recursively resolve a family + all transitive component dependencies. */
    public function resolve(string $family, array &$seen = []): array
    {
        if (in_array($family, $seen, true)) {
            return $seen;
        }

        $seen[] = $family;

        foreach ($this->dependenciesFor($family) as $dep) {
            if ($this->familyExists($dep)) {
                $this->resolve($dep, $seen);
            }
        }

        sort($seen);

        return $seen;
    }

    /** Composer/npm packages a family needs, inferred from its source. */
    public function packagesFor(string $family): array
    {
        $source = $this->sourceFor($family);
        $packages = [];

        // Static (<x-lucide-foo>) or dynamic (<x-dynamic-component :component="'lucide-'.$x">) usage.
        if (str_contains($source, '<x-lucide-') || str_contains($source, "'lucide-")) {
            $packages['composer'][] = 'mallardduck/blade-lucide-icons';
        }
        if (str_contains($source, '->twMerge(')) {
            $packages['composer'][] = 'gehrisandro/tailwind-merge-laravel';
        }
        if (preg_match('/x-anchor/', $source)) {
            $packages['npm'][] = '@alpinejs/anchor';
        }
        if (preg_match('/x-collapse/', $source)) {
            $packages['npm'][] = '@alpinejs/collapse';
        }
        if (preg_match('/x-trap|\$focus/', $source)) {
            $packages['npm'][] = '@alpinejs/focus';
        }
        // Charts are the only component that needs ApexCharts — tie it to the
        // chart family (via its shadcnChart binding) so it's never forced on
        // apps that don't use charts.
        if (str_contains($source, 'shadcnChart')) {
            $packages['npm'][] = 'apexcharts';
        }

        foreach ($packages as $type => $list) {
            $packages[$type] = array_values(array_unique($list));
        }

        return $packages;
    }

    public function sourceDir(): string
    {
        return $this->sourceDir;
    }

    /** Full manifest of every family (for registry.json generation / list). */
    public function manifest(): array
    {
        $manifest = [];

        foreach (array_keys($this->families()) as $family) {
            $manifest[$family] = [
                'name' => $family,
                'files' => array_map('basename', $this->filesFor($family)),
                'dependencies' => $this->dependenciesFor($family),
                'packages' => $this->packagesFor($family),
            ];
        }

        return $manifest;
    }
}
