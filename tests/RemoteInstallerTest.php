<?php

namespace BlatUI\Tests;

use BlatUI\Registry;
use BlatUI\RemoteInstaller;

class RemoteInstallerTest extends TestCase
{
    private string $base;

    protected function setUp(): void
    {
        parent::setUp();
        $this->base = sys_get_temp_dir().'/blatui-remote-'.uniqid();
        mkdir($this->base, 0755, true);
    }

    protected function tearDown(): void
    {
        $this->rrmdir($this->base);
        parent::tearDown();
    }

    public function test_detects_remote_specs(): void
    {
        $this->assertTrue(RemoteInstaller::isRemote('@acme/card'));
        $this->assertTrue(RemoteInstaller::isRemote('https://acme.test/r/card.json'));
        $this->assertTrue(RemoteInstaller::isRemote('acme/card'));
        $this->assertFalse(RemoteInstaller::isRemote('button'));
        $this->assertFalse(RemoteInstaller::isRemote('alert-dialog'));
    }

    public function test_resolves_urls_for_builtin_and_configured_namespaces(): void
    {
        $installer = new RemoteInstaller(new Registry, ['@acme' => 'https://acme.test/r/{name}.json']);

        $this->assertSame('https://blatui.remix-it.com/r/button.json', $installer->resolveUrl('@blatui/button'));
        $this->assertSame('https://acme.test/r/card.json', $installer->resolveUrl('@acme/card'));
        $this->assertSame('https://x.test/r/y.json', $installer->resolveUrl('https://x.test/r/y.json'));
        $this->assertNull($installer->resolveUrl('@unknown/thing'));
    }

    public function test_installs_a_remote_item_and_its_remote_dependencies(): void
    {
        $items = [
            'https://acme.test/r/card.json' => [
                'name' => 'card', 'type' => 'registry:ui',
                'files' => [['target' => 'resources/views/components/ui/acme-card.blade.php', 'content' => 'CARD']],
                'registryDependencies' => ['button'],
                'meta' => ['composer' => ['acme/pkg'], 'npm' => ['acme-js']],
            ],
            'https://acme.test/r/button.json' => [
                'name' => 'button', 'type' => 'registry:ui',
                'files' => [['target' => 'resources/views/components/ui/acme-button.blade.php', 'content' => 'BTN']],
            ],
        ];

        $installer = new RemoteInstaller(
            new Registry,
            ['@acme' => 'https://acme.test/r/{name}.json'],
            fn (string $url) => $items[$url] ?? null,
        );

        $result = $installer->install('@acme/card', $this->base);

        $this->assertFileExists($this->base.'/resources/views/components/ui/acme-card.blade.php');
        $this->assertFileExists($this->base.'/resources/views/components/ui/acme-button.blade.php');
        $this->assertSame('CARD', file_get_contents($this->base.'/resources/views/components/ui/acme-card.blade.php'));
        $this->assertContains('acme/pkg', $result['composer']);
        $this->assertContains('acme-js', $result['npm']);
        $this->assertEmpty($result['errors']);
    }

    public function test_bare_dependency_of_a_url_item_falls_back_to_local_stubs(): void
    {
        $item = [
            'name' => 'fancy', 'type' => 'registry:ui',
            'files' => [['target' => 'resources/views/components/ui/fancy.blade.php', 'content' => 'FANCY']],
            'registryDependencies' => ['button'], // ships locally with this package
        ];

        $installer = new RemoteInstaller(new Registry, [], fn () => $item);
        $result = $installer->install('https://acme.test/r/fancy.json', $this->base);

        $this->assertFileExists($this->base.'/resources/views/components/ui/fancy.blade.php');
        // The bundled button stub was written from local, not fetched.
        $button = $this->base.'/resources/views/components/ui/button.blade.php';
        $this->assertFileExists($button);
        $this->assertStringContainsString('data-slot="button"', file_get_contents($button));
    }

    public function test_a_bundled_block_dependency_lands_in_the_block_namespace(): void
    {
        // installLocalFamily used to hardcode components/ui, so a <x-block.*> piece
        // pulled in as a dependency landed where Blade would never resolve it.
        $item = [
            'name' => 'shell', 'type' => 'registry:block',
            'files' => [['target' => 'resources/views/components/block/shell.blade.php', 'content' => 'SHELL']],
            'registryDependencies' => ['nav-user'], // ships locally, targets components/block
        ];

        $installer = new RemoteInstaller(new Registry, [], fn () => $item);
        $installer->install('https://acme.test/r/shell.json', $this->base);

        $this->assertFileExists($this->base.'/resources/views/components/block/nav-user.blade.php');
        $this->assertFileDoesNotExist($this->base.'/resources/views/components/ui/nav-user.blade.php');
        // …while its own ui dependencies still go to components/ui.
        $this->assertFileExists($this->base.'/resources/views/components/ui/avatar.blade.php');
    }

    public function test_skips_existing_files_without_force(): void
    {
        $item = [
            'name' => 'x', 'type' => 'registry:ui',
            'files' => [['target' => 'resources/views/components/ui/x.blade.php', 'content' => 'NEW']],
        ];
        $installer = new RemoteInstaller(new Registry, [], fn () => $item);

        $path = $this->base.'/resources/views/components/ui/x.blade.php';
        mkdir(dirname($path), 0755, true);
        file_put_contents($path, 'OLD');

        $skip = $installer->install('https://acme.test/r/x.json', $this->base, force: false);
        $this->assertSame('OLD', file_get_contents($path));
        $this->assertNotEmpty($skip['skipped']);

        $force = $installer->install('https://acme.test/r/x.json', $this->base, force: true);
        $this->assertSame('NEW', file_get_contents($path));
        $this->assertNotEmpty($force['written']);
    }

    public function test_unknown_namespace_reports_an_error(): void
    {
        $installer = new RemoteInstaller(new Registry, [], fn () => null);
        $result = $installer->install('@nope/thing', $this->base);

        $this->assertNotEmpty($result['errors']);
        $this->assertEmpty($result['written']);
    }

    private function rrmdir(string $dir): void
    {
        if (! is_dir($dir)) {
            return;
        }
        foreach (scandir($dir) as $f) {
            if ($f === '.' || $f === '..') {
                continue;
            }
            $path = $dir.'/'.$f;
            is_dir($path) ? $this->rrmdir($path) : @unlink($path);
        }
        @rmdir($dir);
    }
}
