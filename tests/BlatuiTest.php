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

    public function test_registry_includes_new_components(): void
    {
        $registry = new Registry;

        foreach (['link', 'rating', 'icon'] as $family) {
            $this->assertTrue($registry->familyExists($family), "{$family} family is missing");
        }

        // sonner-flash ships within the sonner family.
        $this->assertSame('sonner', $registry->familyOf('sonner-flash'));

        // icon renders Lucide via <x-dynamic-component> — it must still declare the dep.
        $this->assertContains(
            'mallardduck/blade-lucide-icons',
            $registry->packagesFor('icon')['composer'] ?? []
        );
    }

    public function test_doctor_flags_typeless_button_in_form(): void
    {
        $dir = sys_get_temp_dir().'/blatui-doctor-'.uniqid();
        @mkdir($dir, 0777, true);
        file_put_contents($dir.'/bad.blade.php', "<form>\n    <x-ui.button>Save</x-ui.button>\n</form>\n");

        $this->artisan('blatui:doctor', ['path' => $dir])->assertFailed();

        @unlink($dir.'/bad.blade.php');
        @rmdir($dir);
    }

    public function test_doctor_is_quiet_on_safe_buttons(): void
    {
        $dir = sys_get_temp_dir().'/blatui-doctor-ok-'.uniqid();
        @mkdir($dir, 0777, true);
        // A typed submit button and an action button with a click handler — both fine.
        file_put_contents(
            $dir.'/ok.blade.php',
            "<form>\n    <x-ui.button type=\"submit\">Save</x-ui.button>\n    <x-ui.button @click=\"cancel()\">Cancel</x-ui.button>\n</form>\n"
        );

        $this->artisan('blatui:doctor', ['path' => $dir])->assertSuccessful();

        @unlink($dir.'/ok.blade.php');
        @rmdir($dir);
    }
}
