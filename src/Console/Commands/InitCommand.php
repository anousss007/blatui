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
            'tw-animate-css' => 'animation utilities the theme CSS imports',
        ] as $package => $why) {
            if (str_contains($pkgJson, '"'.$package.'"')) {
                $this->components->twoColumnDetail($package, '<fg=green>installed</>');
            } else {
                $ok = false;
                $this->components->twoColumnDetail($package." <fg=gray>({$why})</>", '<fg=red>missing</>');
                $this->line("    <fg=yellow>npm install -D {$package}</>");
            }
        }

        // apexcharts is only needed if you use the charts — report it, don't fail on it.
        if (str_contains($pkgJson, '"apexcharts"')) {
            $this->components->twoColumnDetail('apexcharts', '<fg=green>installed</>');
        } else {
            $this->components->twoColumnDetail('apexcharts <fg=gray>(optional — only for charts)</>', '<fg=yellow>not installed</>');
            $this->line('    <fg=yellow>npm install -D apexcharts</>');
        }

        // --- CSS theme tokens ---
        // The foundations only take effect if they're compiled by Vite — i.e.
        // either the tokens live directly in app.css, or the published
        // blatui.css is @imported from app.css (publishing alone is not enough).
        $appCss = is_file(resource_path('css/app.css')) ? file_get_contents(resource_path('css/app.css')) : '';
        $blatuiCssExists = is_file(resource_path('css/blatui.css'));
        $themeInline = str_contains($appCss, '@theme inline') || str_contains($appCss, '--color-popover');
        $importsBlatuiCss = str_contains($appCss, 'blatui.css');

        if ($themeInline || ($blatuiCssExists && $importsBlatuiCss)) {
            $this->components->twoColumnDetail('theme tokens (resources/css/app.css)', '<fg=green>present</>');
        } elseif ($blatuiCssExists && ! $importsBlatuiCss) {
            $ok = false;
            $this->components->twoColumnDetail('theme tokens (published but not imported)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>add  @import "./blatui.css";  to resources/css/app.css</>');
        } else {
            $ok = false;
            $this->components->twoColumnDetail('theme tokens (resources/css)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>php artisan vendor:publish --tag=blatui-foundations</>');
        }

        // --- Alpine bootstrap ---
        $appJs = is_file(resource_path('js/app.js')) ? file_get_contents(resource_path('js/app.js')) : '';
        $blatuiJsExists = is_file(resource_path('js/blatui.js'));
        $bootInline = str_contains($appJs, 'Alpine.start');
        $importsBlatuiJs = str_contains($appJs, 'blatui.js');

        if ($bootInline || ($blatuiJsExists && $importsBlatuiJs)) {
            $this->components->twoColumnDetail('Alpine bootstrap (resources/js/app.js)', '<fg=green>present</>');
        } elseif ($blatuiJsExists && ! $importsBlatuiJs) {
            $ok = false;
            $this->components->twoColumnDetail('Alpine bootstrap (published but not imported)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>add  import "./blatui.js";  to resources/js/app.js</>');
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
