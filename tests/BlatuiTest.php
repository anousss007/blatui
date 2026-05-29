<?php

namespace BlatUI\Tests;

use BlatUI\Registry;

class BlatuiTest extends TestCase
{
    public function test_registry_discovers_component_families(): void
    {
        $registry = new Registry;

        $this->assertGreaterThanOrEqual(50, count($registry->families()));
        $this->assertTrue($registry->familyExists('button'));
        $this->assertTrue($registry->familyExists('dialog'));
    }

    public function test_dependencies_are_resolved(): void
    {
        $registry = new Registry;

        // alert-dialog is its own family and must not collapse into "alert".
        $this->assertTrue($registry->familyExists('alert-dialog'));
        $this->assertSame('alert-dialog', $registry->familyOf('alert-dialog-content'));
    }

    public function test_list_command_runs(): void
    {
        $this->artisan('blatui:list')->assertSuccessful();
    }

    public function test_init_command_runs(): void
    {
        $this->artisan('blatui:init')->assertSuccessful();
    }

    public function test_add_command_copies_files(): void
    {
        $dest = sys_get_temp_dir().'/blatui-test-'.uniqid();

        $this->artisan('blatui:add', ['components' => ['button'], '--path' => $dest])
            ->assertSuccessful();

        $this->assertFileExists($dest.'/button.blade.php');

        // cleanup
        foreach (glob($dest.'/*') ?: [] as $f) {
            @unlink($f);
        }
        @rmdir($dest);
    }

    public function test_unknown_component_fails(): void
    {
        $this->artisan('blatui:add', ['components' => ['does-not-exist']])
            ->assertFailed();
    }
}
