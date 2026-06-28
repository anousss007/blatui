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
            '@floating-ui/dom' => 'viewport-fit positioning for popovers in modals',
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

        // apexcharts is only needed if you use the charts — report it, don't fail on it.
        if (str_contains($pkgJson, '"apexcharts"')) {
            $this->components->twoColumnDetail('apexcharts', '<fg=green>installed</>');
        } else {
            $this->components->twoColumnDetail('apexcharts <fg=gray>(optional — only for charts)</>', '<fg=yellow>not installed</>');
            $this->line('    <fg=yellow>npm install -D apexcharts</>');
        }

        // --- Tailwind CSS v4 (hard requirement) ---
        // Components use v4-only features (@theme inline, oklch, size-*). A v3
        // project must migrate first; there is no v3 compatibility mode.
        if (preg_match('/"tailwindcss":\s*"\D*(\d+)/', $pkgJson, $m)) {
            $major = (int) $m[1];
            if ($major >= 4) {
                $this->components->twoColumnDetail("tailwindcss (v{$major})", '<fg=green>installed</>');
            } else {
                $ok = false;
                $this->components->twoColumnDetail("tailwindcss (v{$major}) <fg=gray>(BlatUI needs v4)</>", '<fg=red>too old</>');
                $this->line('    <fg=yellow>npx @tailwindcss/upgrade</> <fg=gray>— migrate to Tailwind v4, then re-run blatui:init</>');
            }
        } else {
            $ok = false;
            $this->components->twoColumnDetail('tailwindcss <fg=gray>(v4 required)</>', '<fg=red>missing</>');
            $this->line('    <fg=yellow>npm install -D tailwindcss @tailwindcss/vite</>');
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

        // --- Alpine bootstrap / BlatUI engine ---
        // Greenfield: app.js does `import "./blatui.js"`. An app that already runs
        // its own Alpine instead does `import { registerBlatUI } from
        // "./blatui-core.js"` and calls registerBlatUI(Alpine) before Alpine.start().
        $appJs = is_file(resource_path('js/app.js')) ? file_get_contents(resource_path('js/app.js')) : '';
        $blatuiJsExists = is_file(resource_path('js/blatui.js'));
        $importsBootstrap = str_contains($appJs, 'blatui.js') && ! str_contains($appJs, 'blatui-core');
        $registersEngine = str_contains($appJs, 'blatui-core') || str_contains($appJs, 'registerBlatUI');
        $hasOwnAlpine = (bool) preg_match('/from\s+[\'"]alpinejs[\'"]/', $appJs);

        if ($importsBootstrap || $registersEngine) {
            $this->components->twoColumnDetail('BlatUI engine (resources/js/app.js)', '<fg=green>wired</>');
        } elseif ($blatuiJsExists && $hasOwnAlpine) {
            $ok = false;
            $this->components->twoColumnDetail('BlatUI engine <fg=gray>(you already run Alpine)</>', '<fg=red>not registered</>');
            $this->line('    <fg=yellow>import { registerBlatUI } from "./blatui-core.js"</> — call <fg=yellow>registerBlatUI(Alpine)</> before your Alpine.start()');
        } elseif ($blatuiJsExists) {
            $ok = false;
            $this->components->twoColumnDetail('BlatUI engine (published but not imported)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>add  import "./blatui.js";  to resources/js/app.js</>');
        } else {
            $ok = false;
            $this->components->twoColumnDetail('BlatUI engine (resources/js)', '<fg=red>missing</>');
            $this->line('    <fg=yellow>php artisan vendor:publish --tag=blatui-foundations</>');
        }

        // --- Foundation skew (D1) ---
        // blatui:add copies Blade stubs only; a `composer require` bump does NOT re-sync the JS
        // engine. A published-then-customised blatui-core.js can drift behind, so a component
        // expects an Alpine helper the app never registered ("the prop exists but does nothing").
        // Compare by *capability* (registered names), not byte-equality, so an intentional fork
        // that kept all registrations still passes.
        $appCorePath = resource_path('js/blatui-core.js');
        $pkgCorePath = dirname(__DIR__, 3).'/stubs/foundations/blatui-core.js';
        if (is_file($appCorePath) && is_file($pkgCorePath)) {
            $missing = array_values(array_diff(
                $this->foundationApi((string) file_get_contents($pkgCorePath)),
                $this->foundationApi((string) file_get_contents($appCorePath))
            ));
            if ($missing) {
                $ok = false;
                $this->components->twoColumnDetail('foundation engine (resources/js/blatui-core.js)', '<fg=red>out of date</>');
                $this->line('    <fg=gray>missing helpers newer components rely on: </><fg=red>'.implode(', ', $missing).'</>');
                $this->line('    <fg=yellow>php artisan vendor:publish --tag=blatui-foundations --force</> <fg=gray>— re-sync the engine, then re-apply any local customisations</>');
            } else {
                $this->components->twoColumnDetail('foundation engine (resources/js/blatui-core.js)', '<fg=green>in sync</>');
            }
        }

        $this->newLine();
        if ($ok) {
            $this->components->info('All foundations are in place. Add components with: php artisan blatui:add <component>');
        } else {
            $this->components->warn('Some foundations are missing — install the items marked above, then re-run blatui:init.');
        }

        $this->line('  '.count($registry->families()).' components available — see <fg=green>php artisan blatui:list</>');

        $this->offerBoostIntegration($composer);

        return self::SUCCESS;
    }

    /**
     * The public API a foundation engine registers: Alpine.data/directive/magic names and window.*
     * globals. Used to detect a stale published blatui-core.js by capability rather than by
     * byte-equality (which would always differ for an intentionally customised copy).
     *
     * @return array<int, string>
     */
    private function foundationApi(string $js): array
    {
        $names = [];
        if (preg_match_all('/Alpine\.(?:data|directive|magic)\(\s*[\'"]([\w-]+)[\'"]/', $js, $m)) {
            $names = array_merge($names, $m[1]);
        }
        if (preg_match_all('/window\.([A-Za-z_]\w*)\s*=(?!=)/', $js, $m)) {
            $names = array_merge($names, $m[1]);
        }

        return array_values(array_unique($names));
    }

    /**
     * BlatUI ships Laravel Boost guidelines + a "blatui-development" skill under
     * resources/boost/. Boost only picks them up when the user runs
     * boost:update --discover, so — if Boost is installed — offer to run it now,
     * teaching their AI agent how to use BlatUI right after setup.
     */
    protected function offerBoostIntegration(string $composer): void
    {
        if (! str_contains($composer, 'laravel/boost')) {
            return;
        }

        $this->newLine();
        $this->components->info('Laravel Boost detected — BlatUI ships AI guidelines + a "blatui-development" skill.');

        $canUpdate = (bool) $this->getApplication()?->has('boost:update');

        if ($canUpdate && $this->input->isInteractive()
            && $this->confirm('Load BlatUI into your AI agent now? (runs boost:update --discover)', true)) {
            $this->call('boost:update', ['--discover' => true]);

            return;
        }

        $this->line('    <fg=yellow>php artisan boost:update --discover</> — loads BlatUI guidelines + skill into your agent');
    }
}
