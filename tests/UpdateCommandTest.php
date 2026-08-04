<?php

namespace BlatUI\Tests;

use BlatUI\Diff;
use BlatUI\Registry;

class UpdateCommandTest extends TestCase
{
    private string $base;

    private string $ui;

    protected function setUp(): void
    {
        parent::setUp();
        $this->base = sys_get_temp_dir().'/blatui-update-'.uniqid();
        $this->ui = $this->base.'/resources/views/components/ui';
        mkdir($this->ui, 0755, true);
        $this->app->setBasePath($this->base);
    }

    protected function tearDown(): void
    {
        $this->rrmdir($this->base);
        parent::tearDown();
    }

    /** Install a family exactly as `blatui:add` would, then hand back its file paths. */
    private function install(string $family): array
    {
        $paths = [];
        foreach ((new Registry)->filesFor($family) as $src) {
            $target = $this->ui.'/'.basename($src);
            copy($src, $target);
            $paths[] = $target;
        }

        return $paths;
    }

    public function test_reports_nothing_to_do_on_a_clean_install(): void
    {
        $this->install('button');

        $this->artisan('blatui:update')
            ->expectsOutputToContain('Everything is already in sync.')
            ->assertSuccessful();
    }

    public function test_no_installed_components_is_not_an_error(): void
    {
        $this->artisan('blatui:update')->assertSuccessful();
    }

    public function test_a_customised_file_is_never_overwritten_silently(): void
    {
        [$button] = $this->install('button');
        file_put_contents($button, "{{-- our own header --}}\n".file_get_contents($button));
        $customised = file_get_contents($button);

        // Non-interactive (as in CI or a piped shell): report, never write.
        $this->artisan('blatui:update', ['components' => ['button'], '--no-interaction' => true])
            ->expectsOutputToContain('pass --force to overwrite')
            ->assertSuccessful();

        $this->assertSame($customised, file_get_contents($button));
        $this->assertFileDoesNotExist($button.'.bak');
    }

    public function test_force_overwrites_and_keeps_a_backup(): void
    {
        [$button] = $this->install('button');
        $shipped = file_get_contents($button);
        file_put_contents($button, 'LOCAL EDIT');

        $this->artisan('blatui:update', ['components' => ['button'], '--force' => true])
            ->assertSuccessful();

        $this->assertSame($shipped, file_get_contents($button));
        $this->assertSame('LOCAL EDIT', file_get_contents($button.'.bak'));
    }

    public function test_no_backup_skips_the_bak_copy(): void
    {
        [$button] = $this->install('button');
        file_put_contents($button, 'LOCAL EDIT');

        $this->artisan('blatui:update', ['components' => ['button'], '--force' => true, '--no-backup' => true])
            ->assertSuccessful();

        $this->assertFileDoesNotExist($button.'.bak');
    }

    public function test_dry_run_writes_nothing(): void
    {
        [$button] = $this->install('button');
        file_put_contents($button, 'LOCAL EDIT');

        $this->artisan('blatui:update', ['components' => ['button'], '--dry-run' => true, '--force' => true])
            ->expectsOutputToContain('Dry run')
            ->assertSuccessful();

        $this->assertSame('LOCAL EDIT', file_get_contents($button));
        $this->assertFileDoesNotExist($button.'.bak');
    }

    public function test_a_file_the_family_gained_upstream_is_added(): void
    {
        // accordion ships four files; drop one to simulate an install predating it.
        $paths = $this->install('accordion');
        $this->assertGreaterThan(1, count($paths));
        $missing = $paths[1];
        unlink($missing);

        $this->artisan('blatui:update', ['components' => ['accordion']])->assertSuccessful();

        // New files carry no local work, so they land without a prompt.
        $this->assertFileExists($missing);
    }

    public function test_only_the_requested_family_is_touched(): void
    {
        [$button] = $this->install('button');
        [$badge] = $this->install('badge');
        file_put_contents($button, 'A');
        file_put_contents($badge, 'B');

        $this->artisan('blatui:update', ['components' => ['button'], '--force' => true])
            ->assertSuccessful();

        $this->assertNotSame('A', file_get_contents($button));
        $this->assertSame('B', file_get_contents($badge));
    }

    public function test_unknown_family_fails(): void
    {
        $this->install('button');

        $this->artisan('blatui:update', ['components' => ['does-not-exist']])->assertFailed();
    }

    public function test_unknown_family_fails_before_looking_at_the_project(): void
    {
        // Nothing installed: a typo is still a typo, not "nothing to do".
        $this->artisan('blatui:update', ['components' => ['does-not-exist']])->assertFailed();
    }

    public function test_diff_output_shows_the_changed_lines(): void
    {
        [$button] = $this->install('button');
        file_put_contents($button, "LOCAL EDIT\n");

        $this->artisan('blatui:update', ['components' => ['button'], '--diff' => true, '--dry-run' => true])
            ->expectsOutputToContain('@@')
            ->assertSuccessful();
    }

    public function test_diff_reports_line_level_changes(): void
    {
        $old = "a\nb\nc\n";
        $new = "a\nB\nc\n";

        $this->assertSame(['added' => 1, 'removed' => 1], Diff::stat($old, $new));
        $this->assertSame('', Diff::unified($old, $old));

        $unified = Diff::unified($old, $new);
        $this->assertStringContainsString('-b', $unified);
        $this->assertStringContainsString('+B', $unified);
        $this->assertStringContainsString(' a', $unified);
        // Unchanged lines are context, not edits.
        $this->assertStringNotContainsString('-a', $unified);
    }

    public function test_diff_handles_pure_insertions_and_deletions(): void
    {
        $this->assertSame(['added' => 2, 'removed' => 0], Diff::stat("a\n", "a\nb\nc\n"));
        $this->assertSame(['added' => 0, 'removed' => 2], Diff::stat("a\nb\nc\n", "a\n"));
        $this->assertSame(['added' => 0, 'removed' => 0], Diff::stat('same', 'same'));
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
