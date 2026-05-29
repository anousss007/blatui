<?php

namespace App\Console\Commands;

use App\Support\BlatuiRegistry;
use Illuminate\Console\Command;

class BlatuiListCommand extends Command
{
    protected $signature = 'blatui:list {component? : Show details for a single component family}';

    protected $description = 'List the available Blatui components (or show one component\'s details)';

    public function handle(BlatuiRegistry $registry): int
    {
        $families = $registry->families();

        if ($single = $this->argument('component')) {
            if (! $registry->familyExists($single)) {
                $this->components->error("Unknown component: {$single}");

                return self::FAILURE;
            }

            $this->components->info("Component: {$single}");
            $this->line('  <fg=gray>Files:</> '.implode(', ', array_map('basename', $registry->filesFor($single))));

            $deps = $registry->dependenciesFor($single);
            $this->line('  <fg=gray>Depends on:</> '.($deps ? implode(', ', $deps) : 'none'));

            $packages = $registry->packagesFor($single);
            $composer = $packages['composer'] ?? [];
            $npm = $packages['npm'] ?? [];
            $this->line('  <fg=gray>Composer:</> '.($composer ? implode(', ', $composer) : 'none'));
            $this->line('  <fg=gray>npm:</> '.($npm ? implode(', ', $npm) : 'none'));

            $this->newLine();
            $this->line("  Install with: <fg=green>php artisan blatui:add {$single}</>");

            return self::SUCCESS;
        }

        $this->components->info(count($families).' components available');

        $rows = [];
        foreach ($families as $family => $slugs) {
            $deps = $registry->dependenciesFor($family);
            $rows[] = [
                $family,
                count($slugs),
                $deps ? implode(', ', $deps) : '—',
            ];
        }

        $this->table(['Component', 'Files', 'Depends on'], $rows);
        $this->line('  Add one with: <fg=green>php artisan blatui:add <component></>');

        return self::SUCCESS;
    }
}
