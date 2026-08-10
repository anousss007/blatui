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

    /**
     * A root element carrying both a literal class="…" and a bare {{ $attributes }}
     * emits two class attributes: invalid HTML, and the browser drops the consumer's
     * classes. Sonner shipped that way — sweep the whole registry so the next one
     * fails here instead of in someone's app.
     */
    public function test_no_component_emits_a_duplicate_class_attribute(): void
    {
        $offenders = [];

        foreach (array_merge(
            glob(dirname(__DIR__).'/stubs/ui/*.blade.php') ?: [],
            glob(dirname(__DIR__).'/stubs/block/*.blade.php') ?: [],
        ) as $file) {
            $source = (string) file_get_contents($file);

            foreach ($this->bareAttributeTags($source) as $tag) {
                // Blade echoes can legitimately contain the word class inside an
                // expression — only a real attribute on the element counts.
                $withoutEchoes = (string) preg_replace('/\{\{.*?\}\}/s', '', $tag);
                if (preg_match('/\sclass\s*=\s*"/', $withoutEchoes)) {
                    $offenders[] = basename($file);
                }
            }
        }

        $this->assertSame([], array_values(array_unique($offenders)));
    }

    /**
     * Every opening tag that renders a bare {{ $attributes }} (not ->twMerge()).
     *
     * @return list<string>
     */
    private function bareAttributeTags(string $source): array
    {
        $tags = [];

        foreach (['{{ $attributes }}', '{{$attributes}}'] as $needle) {
            $offset = 0;
            while (($at = strpos($source, $needle, $offset)) !== false) {
                $offset = $at + 1;
                // Walk back to the opening '<' of the element it sits in — the tag
                // body may contain '<' inside Alpine expressions, so skip those.
                $start = $at;
                do {
                    $start = strrpos(substr($source, 0, $start), '<');
                } while ($start !== false && ! preg_match('/^<[a-zA-Z\/]/', substr($source, $start, 2)));

                if ($start === false || str_starts_with(substr($source, $start, 3), '<x-')) {
                    continue;
                }

                $tags[] = substr($source, $start, $at - $start);
            }
        }

        return $tags;
    }

    /**
     * <x-ui.sidebar> renders three branches; the collapsible one dropped the
     * attribute bag entirely, so class/id/x-data passed by a consumer vanished.
     */
    public function test_sidebar_forwards_its_attributes_in_every_branch(): void
    {
        $stub = (string) file_get_contents(dirname(__DIR__).'/stubs/ui/sidebar.blade.php');

        // Non-collapsible root, desktop root, and the teleported mobile panel.
        $this->assertStringContainsString("\$rootAttributes->twMerge('bg-sidebar text-sidebar-foreground flex h-full", $stub);
        $this->assertStringContainsString("\$rootAttributes->twMerge('text-sidebar-foreground group peer hidden md:block'", $stub);
        // The mobile panel renders the same slot again, so it needs the consumer's scope
        // attributes too — minus the ones that must not appear twice in one document.
        $this->assertStringContainsString("\$attributes->except(['id', 'role', 'aria-modal', 'aria-label', 'tabindex'])->twMerge(", $stub);

        // twMerge() writes the merged class back into the bag, and the desktop root and the
        // mobile panel are both rendered — merging into the shared bag puts `hidden md:block`
        // on the mobile drawer and it never appears on a phone. Merge into a copy.
        $this->assertStringNotContainsString('$attributes->twMerge(', $stub, 'sidebar must never merge into the shared attribute bag');
    }

    /**
     * Geometry that used to be hardcoded in rem now tracks the --spacing scale, so a theme
     * that changes it doesn't distort the switch pill, the calendar grid or the collapsed
     * sidebar rail. The conversion is only safe because it is a no-op at Tailwind's default
     * .25rem — that arithmetic is the thing to guard, not the string.
     */
    public function test_spacing_derived_geometry_is_unchanged_at_the_default_scale(): void
    {
        $cases = [
            ['switch.blade.php', 4.6, '1.15rem'],
            ['calendar.blade.php', 8, '2rem'],
            ['sidebar-provider.blade.php', 64, '16rem'],
            ['sidebar-provider.blade.php', 12, '3rem'],
        ];

        foreach ($cases as [$file, $n, $original]) {
            $stub = (string) file_get_contents(dirname(__DIR__).'/stubs/ui/'.$file);

            preg_match_all('/calc\(var\(--spacing\)\s*\*\s*([0-9.]+)\)/', $stub, $matches);
            $factors = array_map('floatval', $matches[1]);

            $this->assertContains((float) $n, $factors, "{$file} should derive {$original} from --spacing");
            $this->assertSame($original, $this->rem($n * 0.25), "{$n} × .25rem must still be {$original}");
            // The comments spell the original out on purpose; only real markup counts here.
            $code = preg_replace(['/\{\{--.*?--\}\}/s', '#(?<![:/])//[^\n]*#'], '', $stub);
            $this->assertStringNotContainsString($original, (string) $code, "{$file} still hardcodes {$original}");
        }
    }

    /** Format a rem value the way the original literals were written (2.0 → "2rem"). */
    private function rem(float $value): string
    {
        return rtrim(rtrim(number_format($value, 4, '.', ''), '0'), '.').'rem';
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

    /**
     * Block components (nav-user, team-switcher, file-tree, …) — the <x-block.*> pieces the
     * dashboard/sidebar blocks compose — must be first-class, installable families that ship
     * with the package and target components/block. Regression guard for GitHub issue #10.
     */
    public function test_block_components_are_first_class_installable_families(): void
    {
        $registry = new Registry;

        $blocks = ['nav-user', 'nav-main', 'nav-projects', 'nav-secondary', 'team-switcher', 'version-switcher', 'search-form', 'file-tree'];
        foreach ($blocks as $c) {
            $this->assertTrue($registry->familyExists($c), "{$c} should be a registered family");
            $this->assertSame('resources/views/components/block', $registry->targetFor($c), "{$c} should install to components/block");
            $this->assertFileExists(dirname(__DIR__)."/stubs/block/{$c}.blade.php", "{$c} stub should ship in stubs/block");
        }

        // ui components keep the default target.
        $this->assertSame('resources/views/components/ui', $registry->targetFor('button'));

        // A block component still resolves its own <x-ui.*> dependencies.
        $seen = [];
        $registry->resolve('nav-user', $seen);
        foreach (['avatar', 'dropdown-menu', 'sidebar'] as $dep) {
            $this->assertContains($dep, $seen, "nav-user should resolve its {$dep} dependency");
        }
    }

    public function test_add_routes_each_family_to_its_namespace_dir(): void
    {
        $base = sys_get_temp_dir().'/blatui-ns-'.uniqid();
        @mkdir($base, 0777, true);
        $this->app->setBasePath($base);

        $this->artisan('blatui:add', ['components' => ['nav-user']])->assertSuccessful();

        // The block component lands in components/block; its ui dependency in components/ui.
        $this->assertFileExists($base.'/resources/views/components/block/nav-user.blade.php');
        $this->assertFileExists($base.'/resources/views/components/ui/avatar.blade.php');
        $this->assertFileDoesNotExist($base.'/resources/views/components/block/avatar.blade.php');

        $this->rrmdir($base);
    }

    private function rrmdir(string $dir): void
    {
        foreach (glob($dir.'/*') ?: [] as $f) {
            is_dir($f) ? $this->rrmdir($f) : @unlink($f);
        }
        @rmdir($dir);
    }
}
