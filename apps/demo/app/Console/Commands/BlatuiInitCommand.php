<?php

namespace App\Console\Commands;

use App\Support\BlatuiRegistry;
use Illuminate\Console\Command;

class BlatuiInitCommand extends Command
{
    protected $signature = 'blatui:init';

    protected $description = 'Check the Blatui foundations (packages, theme tokens, Alpine setup) and report what is missing';

    public function handle(BlatuiRegistry $registry): int
    {
        $this->components->info('Blatui — checking foundations');

        $ok = true;

        // --- Composer packages ---
        $composerLock = base_path('composer.json');
        $composer = is_file($composerLock) ? file_get_contents($composerLock) : '';
        foreach ([
            'gehrisandro/tailwind-merge-laravel' => 'twMerge() macro (the cn() equivalent)',
            'mallardduck/blade-lucide-icons' => '<x-lucide-*> icons',
        ] as $package => $why) {
            if (str_contains($composer, $package)) {
                $this->components->twoColumnDetail($package, '<fg=green>installed</>');
            } else {
                $ok = false;
                $this->components->twoColumnDetail($package." <fg=gray>({$why})</>", '<fg=red>missing</>');
                $this->line("    <fg=yellow>composer require {$package}</>");
            }
        }

        // --- npm Alpine plugins ---
        $pkgJsonPath = base_path('package.json');
        $pkgJson = is_file($pkgJsonPath) ? file_get_contents($pkgJsonPath) : '';
        foreach ([
            '@alpinejs/anchor' => 'positioning for popovers/menus',
            '@alpinejs/collapse' => 'accordion/collapsible animation',
            '@alpinejs/focus' => 'focus traps for dialogs',
        ] as $package => $why) {
            if (str_contains($pkgJson, $package)) {
                $this->components->twoColumnDetail($package, '<fg=green>installed</>');
            } else {
                $ok = false;
                $this->components->twoColumnDetail($package." <fg=gray>({$why})</>", '<fg=red>missing</>');
                $this->line("    <fg=yellow>npm install -D {$package}</>");
            }
        }

        // --- CSS theme tokens ---
        $cssPath = resource_path('css/app.css');
        $css = is_file($cssPath) ? file_get_contents($cssPath) : '';
        $hasTheme = str_contains($css, '--color-popover') || str_contains($css, '@theme inline');
        if ($hasTheme) {
            $this->components->twoColumnDetail('resources/css/app.css theme tokens', '<fg=green>present</>');
        } else {
            $ok = false;
            $this->components->twoColumnDetail('resources/css/app.css theme tokens', '<fg=red>missing</>');
            $this->line('    <fg=gray>Add the shadcn oklch CSS variables + @theme inline block.</>');
        }

        // --- Alpine bootstrap ---
        $jsPath = resource_path('js/app.js');
        $js = is_file($jsPath) ? file_get_contents($jsPath) : '';
        if (str_contains($js, 'Alpine.start')) {
            $this->components->twoColumnDetail('resources/js/app.js Alpine bootstrap', '<fg=green>present</>');
        } else {
            $ok = false;
            $this->components->twoColumnDetail('resources/js/app.js Alpine bootstrap', '<fg=red>missing</>');
            $this->line('    <fg=gray>Import Alpine + plugins and call Alpine.start().</>');
        }

        $this->newLine();
        if ($ok) {
            $this->components->info('All foundations are in place. Add components with: php artisan blatui:add <component>');
        } else {
            $this->components->warn('Some foundations are missing — install the items marked above, then re-run blatui:init.');
        }

        $this->line('  '.count($registry->families()).' components available — see <fg=green>php artisan blatui:list</>');

        return self::SUCCESS;
    }
}
