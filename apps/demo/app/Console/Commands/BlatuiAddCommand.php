<?php

namespace App\Console\Commands;

use App\Support\BlatuiRegistry;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class BlatuiAddCommand extends Command
{
    protected $signature = 'blatui:add
        {components?* : One or more component families to add}
        {--all : Add every available component}
        {--force : Overwrite components that already exist}
        {--path= : Destination directory (default: resources/views/components/ui)}';

    protected $description = 'Copy Blatui component(s) and their dependencies into your project';

    public function handle(BlatuiRegistry $registry): int
    {
        $requested = $this->option('all')
            ? array_keys($registry->families())
            : (array) $this->argument('components');

        if (empty($requested)) {
            $this->components->error('Specify at least one component, or use --all.');
            $this->line('  See available components: <fg=green>php artisan blatui:list</>');

            return self::FAILURE;
        }

        // Validate up front.
        $unknown = array_filter($requested, fn ($c) => ! $registry->familyExists($c));
        if ($unknown) {
            $this->components->error('Unknown component(s): '.implode(', ', $unknown));

            return self::FAILURE;
        }

        // Resolve transitive dependencies across all requested families.
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
        $composerPkgs = [];
        $npmPkgs = [];

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
        $this->components->info("Added ".count($resolved)." component(s): {$copied} file(s) copied".($skipped ? ", {$skipped} skipped" : '').'.');

        if ($skipped && ! $this->option('force')) {
            $this->line('  <fg=gray>Use --force to overwrite existing files.</>');
        }

        $composerPkgs = array_values(array_unique($composerPkgs));
        $npmPkgs = array_values(array_unique($npmPkgs));

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

        return self::SUCCESS;
    }
}
