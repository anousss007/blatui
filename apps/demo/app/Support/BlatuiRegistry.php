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
        'context-menu', 'date-picker', 'dialog', 'drawer', 'dropdown-menu', 'empty',
        'field', 'hover-card', 'input-otp', 'input-group', 'input', 'item', 'kbd',
        'label', 'menubar', 'navigation-menu', 'pagination', 'popover', 'progress',
        'radio-group', 'resizable', 'scroll-area', 'select', 'separator', 'sheet',
        'sidebar', 'skeleton', 'slider', 'sonner', 'spinner', 'switch', 'table',
        'tabs', 'textarea', 'toggle-group', 'toggle', 'tooltip',
    ];

    public function __construct(
        protected string $sourceDir = '',
    ) {
        if ($this->sourceDir === '') {
            $this->sourceDir = resource_path('views/components/ui');
        }
    }

    /** Roots ordered longest-first so prefix matching is unambiguous. */
    protected function rootsByLength(): array
    {
        $roots = self::ROOTS;
        usort($roots, fn ($a, $b) => strlen($b) <=> strlen($a));

        return $roots;
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

    /** All slugs present in the source directory. */
    public function slugs(): array
    {
        $files = glob($this->sourceDir.'/*.blade.php') ?: [];

        return collect($files)
            ->map(fn ($f) => Str::beforeLast(basename($f), '.blade.php'))
            ->sort()
            ->values()
            ->all();
    }

    /** Group every slug into its family => [slugs...]. */
    public function families(): array
    {
        $families = [];

        foreach ($this->slugs() as $slug) {
            $family = $this->familyOf($slug) ?? $slug;
            $families[$family][] = $slug;
        }

        ksort($families);

        return $families;
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

    /** Concatenated source of a family (used for dependency scanning). */
    protected function sourceFor(string $family): string
    {
        return collect($this->filesFor($family))
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

        if (str_contains($source, '<x-lucide-')) {
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
