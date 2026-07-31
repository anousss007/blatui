<?php

namespace BlatUI;

use RuntimeException;

/**
 * Reads the BlatUI component manifest (registry.json) that ships alongside the
 * bundled Blade stubs and answers the queries the CLI needs to copy a family
 * and everything it depends on into a consuming project.
 *
 * The manifest is the single source of truth: it is generated in the demo repo
 * by `php artisan blatui:registry:build` and copied here by
 * scripts/sync-package.sh. This class never re-derives families or
 * dependencies — it trusts the manifest verbatim.
 */
class Registry
{
    /** @var array<string, array{name: string, files: list<string>, dependencies: list<string>, packages: array}> */
    protected array $manifest;

    /** Directory holding the component .blade.php stubs the manifest describes. */
    protected string $stubsDir;

    public function __construct(?string $manifestPath = null, ?string $stubsDir = null)
    {
        $manifestPath ??= dirname(__DIR__).'/stubs/registry.json';
        $this->stubsDir = $stubsDir ?? dirname(__DIR__).'/stubs/ui';

        if (! is_file($manifestPath)) {
            throw new RuntimeException(
                "BlatUI registry manifest not found at {$manifestPath}. ".
                'Re-run scripts/sync-package.sh from the demo repo.'
            );
        }

        $decoded = json_decode((string) file_get_contents($manifestPath), true);

        if (! is_array($decoded)) {
            throw new RuntimeException("BlatUI registry manifest at {$manifestPath} is not valid JSON.");
        }

        $this->manifest = $decoded;
    }

    /** Map a component slug to its family root, or null if unknown. */
    public function familyOf(string $slug): ?string
    {
        foreach ($this->manifest as $family => $entry) {
            if (in_array($slug.'.blade.php', $entry['files'] ?? [], true)) {
                return $family;
            }
        }

        return null;
    }

    /** All slugs present across every family. */
    public function slugs(): array
    {
        $slugs = [];

        foreach ($this->families() as $familySlugs) {
            foreach ($familySlugs as $slug) {
                $slugs[] = $slug;
            }
        }

        sort($slugs);

        return $slugs;
    }

    /** Group every slug into its family => [slugs...]. */
    public function families(): array
    {
        $families = [];

        foreach ($this->manifest as $family => $entry) {
            $families[$family] = array_map(
                fn (string $file) => basename($file, '.blade.php'),
                $entry['files'] ?? []
            );
        }

        return $families;
    }

    public function familyExists(string $family): bool
    {
        return array_key_exists($family, $this->manifest);
    }

    /**
     * Install target (path relative to the project root) for a family. Block/
     * components (nav-user, team-switcher, file-tree, …) install to
     * components/block and render as <x-block.*>; everything else defaults to
     * components/ui. Absent `target` ⇒ ui, so older manifests still work.
     */
    public function targetFor(string $family): string
    {
        return $this->manifest[$family]['target'] ?? 'resources/views/components/ui';
    }

    /** Absolute file paths that make up a family (read from the matching stubs/ subdir). */
    public function filesFor(string $family): array
    {
        $files = $this->manifest[$family]['files'] ?? [];
        // stubsDir is stubs/ui; sibling stubs/<namespace> holds other targets (e.g. stubs/block).
        $namespace = basename($this->targetFor($family));           // ui | block
        $dir = $namespace === 'ui' ? $this->stubsDir : dirname($this->stubsDir).'/'.$namespace;

        return array_map(fn (string $file) => $dir.'/'.$file, $files);
    }

    /** Other component families this family references. */
    public function dependenciesFor(string $family): array
    {
        return $this->manifest[$family]['dependencies'] ?? [];
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

    /** Composer/npm packages a family needs. */
    public function packagesFor(string $family): array
    {
        return $this->manifest[$family]['packages'] ?? [];
    }

    public function sourceDir(): string
    {
        return $this->stubsDir;
    }

    /** Full manifest of every family. */
    public function manifest(): array
    {
        return $this->manifest;
    }
}
