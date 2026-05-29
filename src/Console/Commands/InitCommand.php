<?php

namespace BlatUI\Console\Commands;

use BlatUI\Registry;
use Illuminate\Console\Command;

class InitCommand extends Command
{
    protected $signature = 'blatui:init';

    protected $description = 'Check the BlatUI foundations (packages, theme tokens, Alpine setup) and report what is missing';

    public function handle(Registry $registry): int
    {
        $this->components->info('BlatUI — checking foundations');

        $ok = true;

        // --- Composer packages ---
        $composerPath = base_path('composer.json');
        $composer = is_file($composerPath) ? file_get_contents($composerPath) : '';
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
            'alpinejs' => 'the Alpine.js runtime',
            '@alpinejs/anchor' => 'positioning for popovers/menus',
            '@alpinejs/collapse' => 'accordion/collapsible animation',
            '@alpinejs/focus' => 'focus traps for dialogs',
        ] as $package => $why) {
            if (str_contains($pkgJson, '"'.$package.'"')) {
                $this->components->twoColumnDetail($package, '<fg=green>installed</>');
            } else {
                $ok = false;
                $this->components->twoColumnDetail($package." <fg=gray>({$why})</>", '<fg=red>missing</>');
                $this->line("    <fg=yellow>npm install -D {$package}</>");
            }
        }

        // --- CSS theme tokens ---
        $css = '';
        foreach (['css/app.css', 'css/blatui.css'] as $rel) {
            $path = resource_path($rel);
            if (is_file($path)) {
                $css .= file_get_contents($path);
            }
        }
        $hasTheme = str_contains($css, '--color-popover') || str_contains($css, '@theme inline');
        if ($hasTheme) {
            $this->components->twoColumnDetail('theme tokens (resources/css)', '<fg=green>present</>');
        } else {
            $ok = false;
            $this->components->twoColumnDetail('theme tokens (resources/css)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>php artisan vendor:publish --tag=blatui-foundations</>');
        }

        // --- Alpine bootstrap ---
        $js = '';
        foreach (['js/app.js', 'js/blatui.js'] as $rel) {
            $path = resource_path($rel);
            if (is_file($path)) {
                $js .= file_get_contents($path);
            }
        }
        if (str_contains($js, 'Alpine.start')) {
            $this->components->twoColumnDetail('Alpine bootstrap (resources/js)', '<fg=green>present</>');
        } else {
            $ok = false;
            $this->components->twoColumnDetail('Alpine bootstrap (resources/js)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>php artisan vendor:publish --tag=blatui-foundations</>');
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
