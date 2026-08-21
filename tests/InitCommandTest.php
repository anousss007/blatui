<?php

namespace BlatUI\Tests;

use Illuminate\Support\Facades\Artisan;

/**
 * blatui:init reads a real project's composer.json / package.json / resources, so the tests
 * point the app at a temporary skeleton and read the report back.
 */
class InitCommandTest extends TestCase
{
    /** @var list<string> */
    private array $temps = [];

    protected function tearDown(): void
    {
        foreach ($this->temps as $dir) {
            $entries = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );
            foreach ($entries as $entry) {
                $entry->isDir() ? @rmdir($entry->getPathname()) : @unlink($entry->getPathname());
            }
            @rmdir($dir);
        }

        parent::tearDown();
    }

    /**
     * Livewire bundles Alpine and starts it, so a Livewire-only project has no `alpinejs` npm
     * package and must not be told to install one — a second Alpine on the page is its own bug.
     * Reporting it missing also failed the whole run, so a correctly wired app was told its
     * foundations were incomplete. Issue #22.
     */
    public function test_alpine_is_reported_as_provided_in_a_livewire_project(): void
    {
        $output = $this->runInit(livewire: true);

        $this->assertStringContainsString('bundled and started by Livewire', $output);
        $this->assertStringNotContainsString('npm install -D alpinejs', $output);
        $this->assertStringContainsString('All foundations are in place', $output);
    }

    /** Without Livewire nothing provides Alpine, so the same check must still ask for it. */
    public function test_alpine_is_still_required_without_livewire(): void
    {
        $output = $this->runInit(livewire: false);

        $this->assertStringContainsString('npm install -D alpinejs', $output);
        $this->assertStringNotContainsString('bundled and started by Livewire', $output);
    }

    /** The plugins are build dependencies of blatui-core.js — Livewire does not provide those. */
    public function test_the_alpine_plugins_are_still_required_under_livewire(): void
    {
        $output = $this->runInit(livewire: true, plugins: false);

        $this->assertStringContainsString('npm install -D @alpinejs/anchor', $output);
    }

    /**
     * A Livewire app that followed get-started imports blatui.js, which bundles an Alpine that
     * Livewire already provides — and needs the npm package the check above just said it does not.
     */
    public function test_a_livewire_app_on_the_greenfield_bootstrap_is_pointed_at_the_engine(): void
    {
        $output = $this->runInit(livewire: true, bootstrap: true);

        $this->assertStringContainsString('registerBlatUI', $output);
        $this->assertStringContainsString('alpine:init', $output);
    }

    private function runInit(bool $livewire, bool $plugins = true, bool $bootstrap = false): string
    {
        $dir = sys_get_temp_dir().'/blatui-init-'.uniqid();
        $this->temps[] = $dir;
        @mkdir($dir.'/resources/css', 0777, true);
        @mkdir($dir.'/resources/js', 0777, true);

        $require = ['gehrisandro/tailwind-merge-laravel' => '^1.4', 'mallardduck/blade-lucide-icons' => '^2.0'];
        if ($livewire) {
            $require['livewire/livewire'] = '^4.0';
        }
        file_put_contents($dir.'/composer.json', json_encode(['require' => $require], JSON_UNESCAPED_SLASHES));

        $dev = ['tailwindcss' => '^4.0'];
        if ($plugins) {
            $dev += ['@alpinejs/anchor' => '^3.15', '@floating-ui/dom' => '^1.7', '@alpinejs/collapse' => '^3.15', '@alpinejs/focus' => '^3.15'];
        }
        file_put_contents($dir.'/package.json', json_encode(['devDependencies' => $dev], JSON_UNESCAPED_SLASHES));

        file_put_contents($dir.'/resources/css/app.css', "@import './blatui.css';\n");
        file_put_contents($dir.'/resources/css/blatui.css', "@theme inline {}\n");
        file_put_contents($dir.'/resources/js/blatui.js', "// bootstrap\n");
        file_put_contents(
            $dir.'/resources/js/app.js',
            $bootstrap
                ? "import './blatui.js';\n"
                : "import { registerBlatUI } from './blatui-core.js';\ndocument.addEventListener('alpine:init', () => registerBlatUI(window.Alpine));\n"
        );
        // The engine is compared by capability, so ship the real one — a stub would read as stale.
        copy(dirname(__DIR__).'/stubs/foundations/blatui-core.js', $dir.'/resources/js/blatui-core.js');

        $this->app->setBasePath($dir);
        Artisan::call('blatui:init');

        return Artisan::output();
    }
}
