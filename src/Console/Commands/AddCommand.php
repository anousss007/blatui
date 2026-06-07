<?php

namespace BlatUI\Console\Commands;

use BlatUI\Registry;
use BlatUI\RemoteInstaller;
use Illuminate\Console\Command;

class AddCommand extends Command
{
    protected $signature = 'blatui:add
        {components?* : Component families, or @namespace/name / URL for remote items}
        {--all : Add every available (bundled) component}
        {--force : Overwrite components that already exist}
        {--path= : Destination directory (default: resources/views/components/ui)}';

    protected $description = 'Copy BlatUI component(s) and their dependencies into your project';

    public function handle(Registry $registry): int
    {
        $requested = $this->option('all')
            ? array_keys($registry->families())
            : (array) $this->argument('components');

        if (empty($requested)) {
            $this->components->error('Specify at least one component, or use --all.');
            $this->line('  See available components: <fg=green>php artisan blatui:list</>');

            return self::FAILURE;
        }

        // A spec is remote when it is a URL or a @namespace/name; everything
        // else is a locally-bundled family.
        $remoteSpecs = array_values(array_filter($requested, fn ($c) => RemoteInstaller::isRemote($c)));
        $localReq = array_values(array_filter($requested, fn ($c) => ! RemoteInstaller::isRemote($c)));

        $composerPkgs = [];
        $npmPkgs = [];

        if ($localReq && ($code = $this->addLocal($registry, $localReq, $composerPkgs, $npmPkgs)) !== self::SUCCESS) {
            return $code;
        }

        if ($remoteSpecs) {
            $this->addRemote($registry, $remoteSpecs, $composerPkgs, $npmPkgs);
        }

        $this->suggestPackages($composerPkgs, $npmPkgs);

        return self::SUCCESS;
    }

    /** Copy locally-bundled families (the default, offline path). */
    protected function addLocal(Registry $registry, array $requested, array &$composerPkgs, array &$npmPkgs): int
    {
        $unknown = array_filter($requested, fn ($c) => ! $registry->familyExists($c));
        if ($unknown) {
            $this->components->error('Unknown component(s): '.implode(', ', $unknown));
            $this->line('  Install from a registry with <fg=green>@namespace/name</> or a URL.');

            return self::FAILURE;
        }

        $resolved = [];
        foreach ($requested as $family) {
            $registry->resolve($family, $resolved);
        }
        $resolved = collect($resolved)->unique()->sort()->values()->all();

        $dest = $this->option('path') ?: resource_path('views/components/ui');
        if (! is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        $extras = array_values(array_diff($resolved, $requested));
        if ($extras) {
            $this->components->info('Including dependencies: '.implode(', ', $extras));
        }

        $copied = 0;
        $skipped = 0;
        foreach ($resolved as $family) {
            foreach ($registry->filesFor($family) as $src) {
                $target = $dest.'/'.basename($src);
                if (is_file($target) && ! $this->option('force')) {
                    $skipped++;

                    continue;
                }
                copy($src, $target);
                $copied++;
            }

            $packages = $registry->packagesFor($family);
            $composerPkgs = array_merge($composerPkgs, $packages['composer'] ?? []);
            $npmPkgs = array_merge($npmPkgs, $packages['npm'] ?? []);
        }

        $this->newLine();
        $this->components->info('Added '.count($resolved).' component(s): '.$copied.' file(s) copied'.($skipped ? ", {$skipped} skipped" : '').'.');
        if ($skipped && ! $this->option('force')) {
            $this->line('  <fg=gray>Use --force to overwrite existing files.</>');
        }

        return self::SUCCESS;
    }

    /** Fetch + write items from remote, shadcn-compatible registries. */
    protected function addRemote(Registry $registry, array $specs, array &$composerPkgs, array &$npmPkgs): void
    {
        $installer = new RemoteInstaller($registry, (array) config('blatui.registries', []));
        // Remote items carry their own `target` paths (relative to the app root).
        $basePath = base_path();

        foreach ($specs as $spec) {
            $this->newLine();
            $this->components->info("Fetching {$spec} …");
            $result = $installer->install($spec, $basePath, (bool) $this->option('force'));

            foreach ($result['written'] as $path) {
                $this->line('  <fg=green>+</> '.$this->relative($path, $basePath));
            }
            if ($result['skipped']) {
                $this->line('  <fg=gray>'.count($result['skipped']).' existing file(s) skipped (use --force).</>');
            }
            foreach ($result['errors'] as $error) {
                $this->components->error($error);
            }

            $composerPkgs = array_merge($composerPkgs, $result['composer']);
            $npmPkgs = array_merge($npmPkgs, $result['npm']);
        }
    }

    protected function suggestPackages(array $composerPkgs, array $npmPkgs): void
    {
        $composerPkgs = array_values(array_unique($composerPkgs));
        $npmPkgs = array_values(array_unique($npmPkgs));

        // Only suggest peers the project doesn't already declare.
        $composerJson = is_file(base_path('composer.json')) ? (string) file_get_contents(base_path('composer.json')) : '';
        $packageJson = is_file(base_path('package.json')) ? (string) file_get_contents(base_path('package.json')) : '';
        $composerPkgs = array_values(array_filter($composerPkgs, fn ($p) => ! str_contains($composerJson, $p)));
        $npmPkgs = array_values(array_filter($npmPkgs, fn ($p) => ! str_contains($packageJson, '"'.$p.'"')));

        if ($composerPkgs || $npmPkgs) {
            $this->newLine();
            $this->components->info('Required packages:');
            if ($composerPkgs) {
                $this->line('  <fg=yellow>composer require '.implode(' ', $composerPkgs).'</>');
            }
            if ($npmPkgs) {
                $this->line('  <fg=yellow>npm install -D '.implode(' ', $npmPkgs).'</>');
            }
        }
    }

    protected function relative(string $path, string $basePath): string
    {
        return ltrim(str_replace('\\', '/', str_replace($basePath, '', $path)), '/');
    }
}
