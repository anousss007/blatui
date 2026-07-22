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

    public function test_qr_code_binds_viewbox_with_correct_case(): void
    {
        // SVG's `viewBox` is case-sensitive. A plain Alpine `:viewBox` bind is lowercased
        // to `viewbox` by the HTML parser and silently ignored, so the code never scales to
        // `size` (it renders at 1px per module). Alpine's `.camel` modifier restores the
        // casing — guard against a regression back to the case-sensitive plain bind.
        $stub = file_get_contents(dirname(__DIR__).'/stubs/ui/qr-code.blade.php');

        $this->assertStringContainsString(':view-box.camel="viewBox"', $stub);
        $this->assertStringNotContainsString(':viewBox="viewBox"', $stub);
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

    public function test_doctor_flags_leaked_xui_tag_in_compiled_view(): void
    {
        $src = sys_get_temp_dir().'/blatui-src-'.uniqid();
        $compiled = sys_get_temp_dir().'/blatui-compiled-'.uniqid();
        @mkdir($src, 0777, true);
        @mkdir($compiled, 0777, true);

        // A compiled view where an <x-ui.input> failed to compile and leaked into the output.
        file_put_contents($compiled.'/abc123.php', "<?php /* compiled */ ?>\n<div><x-ui.input type=\"email\" /></div>\n");

        $this->artisan('blatui:doctor', ['path' => $src, '--compiled' => $compiled])->assertFailed();

        @unlink($compiled.'/abc123.php');
        @rmdir($compiled);
        @rmdir($src);
    }

    public function test_doctor_ignores_encoded_xui_in_compiled_view(): void
    {
        $src = sys_get_temp_dir().'/blatui-src-'.uniqid();
        $compiled = sys_get_temp_dir().'/blatui-compiled-ok-'.uniqid();
        @mkdir($src, 0777, true);
        @mkdir($compiled, 0777, true);

        // HTML-encoded references (docs showing code) must NOT be flagged.
        file_put_contents($compiled.'/def456.php', "<?php ?>\n<code>&lt;x-ui.input /&gt;</code>\n");

        $this->artisan('blatui:doctor', ['path' => $src, '--compiled' => $compiled])->assertSuccessful();

        @unlink($compiled.'/def456.php');
        @rmdir($compiled);
        @rmdir($src);
    }

    public function test_doctor_ignores_button_inside_a_blade_comment(): void
    {
        $dir = sys_get_temp_dir().'/blatui-doctor-cmt-'.uniqid();
        @mkdir($dir, 0777, true);
        // A note explaining why a component is NOT used here must not be flagged as a footgun.
        file_put_contents(
            $dir.'/note.blade.php',
            "<form>\n    {{-- avoid <x-ui.button> here, it won't submit --}}\n    <button type=\"submit\">Save</button>\n</form>\n"
        );

        $this->artisan('blatui:doctor', ['path' => $dir])->assertSuccessful();

        @unlink($dir.'/note.blade.php');
        @rmdir($dir);
    }

    public function test_doctor_ignores_xui_tag_inside_a_comment_in_compiled_view(): void
    {
        $src = sys_get_temp_dir().'/blatui-src-'.uniqid();
        $compiled = sys_get_temp_dir().'/blatui-compiled-cmt-'.uniqid();
        @mkdir($src, 0777, true);
        @mkdir($compiled, 0777, true);

        // <x-ui.*> mentioned only inside an HTML comment or a PHP comment is not a real leak.
        file_put_contents(
            $compiled.'/ghi789.php',
            "<?php // do not slot <x-ui.input/> through @aware ?>\n<div><!-- was <x-ui.input /> --></div>\n"
        );

        $this->artisan('blatui:doctor', ['path' => $src, '--compiled' => $compiled])->assertSuccessful();

        @unlink($compiled.'/ghi789.php');
        @rmdir($compiled);
        @rmdir($src);
    }
}
