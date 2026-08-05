<?php

namespace BlatUI\Console\Commands;

use BlatUI\Diff;
use BlatUI\Registry;
use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatter;

/**
 * Brings already-installed components back in line with the versions this
 * package ships — the missing half of the copy-not-dependency model.
 *
 * `blatui:add --force` was the only way to re-sync a component, and it silently
 * overwrote local files: a consumer who customised a component (the entire point
 * of owning the code) lost that work with no diff, no prompt and no backup.
 *
 * This command needs no lockfile and writes no state into the consuming app: the
 * package already ships the exact stub each component was copied from, so a byte
 * comparison against it is enough to answer "does my copy differ from the one
 * this version ships?". It cannot tell *why* it differs — a local customisation
 * and an outdated copy look identical — so anything that differs is shown as a
 * diff and confirmed per file rather than overwritten.
 *
 * The one case a byte comparison over-reports is a formatter: a project running
 * Pint/Prettier across resources/views rewrites the layout of the components it
 * copied, and every one of them then reads as changed. --ignore-whitespace
 * classifies those as up to date. They are counted on their own line either way,
 * so the default stays byte-honest without leaving the noise unexplained.
 */
class UpdateCommand extends Command
{
    protected $signature = 'blatui:update
        {components?* : Component families to update (default: every installed family)}
        {--diff : Print the full unified diff for each file that differs}
        {--dry-run : Report what would change without writing anything}
        {--ignore-whitespace : Treat files that differ only in layout (a formatter ran over them) as up to date}
        {--force : Overwrite differing files without confirming}
        {--no-backup : Skip the .bak copy written before an overwrite}
        {--path= : Directory holding the installed components (default: each family\'s namespace dir)}';

    protected $description = 'Sync installed BlatUI components with the versions this package ships';

    public function handle(Registry $registry): int
    {
        $requested = (array) $this->argument('components');

        $unknown = array_values(array_filter($requested, fn ($c) => ! $registry->familyExists($c)));
        if ($unknown) {
            $this->components->error('Unknown component(s): '.implode(', ', $unknown));
            $this->line('  <fg=gray>See what exists: </><fg=green>php artisan blatui:list</>');

            return self::FAILURE;
        }

        $installed = $this->installedFamilies($registry);

        if (! $installed) {
            $this->components->warn('No installed BlatUI components found.');
            $this->line('  <fg=gray>Add some first: </><fg=green>php artisan blatui:add button</>');

            return self::SUCCESS;
        }

        if ($requested) {
            $missing = array_values(array_diff($requested, array_keys($installed)));
            if ($missing) {
                $this->components->warn('Not installed, skipping: '.implode(', ', $missing));
                $this->line('  <fg=gray>Install them with </><fg=green>php artisan blatui:add '.implode(' ', $missing).'</>');
            }

            $installed = array_intersect_key($installed, array_flip($requested));
        }

        $upToDate = 0;
        $reformatted = 0; // same content, different layout — a formatter ran over them
        $changed = [];    // files that differ from the shipped stub
        $added = [];      // files a family gained upstream that this app never got

        foreach ($installed as $files) {
            foreach ($files as $target => $src) {
                $stub = is_file($src) ? (string) file_get_contents($src) : '';

                if (! is_file($target)) {
                    $added[$target] = $stub;

                    continue;
                }

                $local = (string) file_get_contents($target);
                if ($local === $stub) {
                    $upToDate++;

                    continue;
                }

                if (Diff::sameIgnoringWhitespace($local, $stub)) {
                    $reformatted++;

                    // Byte identity is the honest default — say what was found, and only
                    // skip these when asked to. Nothing is hidden either way.
                    if ($this->option('ignore-whitespace')) {
                        continue;
                    }
                }

                $changed[$target] = [$local, $stub];
            }
        }

        $ignoringWhitespace = (bool) $this->option('ignore-whitespace');

        $this->newLine();
        $this->components->twoColumnDetail('<fg=gray>up to date</>', (string) $upToDate.' file(s)');
        if ($reformatted) {
            $this->components->twoColumnDetail(
                '<fg=gray>same content, reformatted</>',
                (string) $reformatted.' file(s)'.($ignoringWhitespace ? ' <fg=gray>(skipped)</>' : '')
            );
        }
        $this->components->twoColumnDetail('<fg=yellow>differs from registry</>', (string) count($changed).' file(s)');
        if ($added) {
            $this->components->twoColumnDetail('<fg=green>new in this version</>', (string) count($added).' file(s)');
        }

        // A project that runs a formatter over resources/views reformats the components it
        // copied; without this the real drift is a third of the list and easy to miss.
        if ($reformatted && ! $ignoringWhitespace) {
            $this->line('  <fg=gray>'.$reformatted.' of these differ only in layout — </><fg=green>--ignore-whitespace</><fg=gray> leaves them alone.</>');
        }

        if (! $changed && ! $added) {
            $this->newLine();
            $this->components->info('Everything is already in sync.');

            return self::SUCCESS;
        }

        $written = 0;
        $skipped = 0;
        $dryRun = (bool) $this->option('dry-run');

        // New files carry no local work, so they are never a destructive write.
        foreach ($added as $target => $stub) {
            $this->newLine();
            $this->components->twoColumnDetail('<fg=green>+</> '.$this->relative($target), '<fg=green>new file</>');
            if ($dryRun) {
                continue;
            }
            $this->write($target, $stub);
            $written++;
        }

        foreach ($changed as $target => [$local, $stub]) {
            $stat = Diff::stat($local, $stub);
            $this->newLine();
            $this->components->twoColumnDetail(
                '<fg=yellow>~</> '.$this->relative($target),
                "<fg=green>+{$stat['added']}</> <fg=red>-{$stat['removed']}</>"
            );

            if ($this->option('diff')) {
                $this->renderDiff($local, $stub, $this->relative($target));
            }

            if ($dryRun) {
                continue;
            }

            if (! $this->shouldOverwrite($target)) {
                $skipped++;

                continue;
            }

            if (! $this->option('no-backup')) {
                copy($target, $target.'.bak');
                $this->line('  <fg=gray>your version was kept at '.$this->relative($target).'.bak</>');
            }
            $this->write($target, $stub);
            $written++;
        }

        $this->newLine();
        if ($dryRun) {
            $this->components->info('Dry run — nothing was written. Re-run without --dry-run to apply.');
            if (! $this->option('diff')) {
                // Carry the flags they are already using — a suggestion that drops
                // --ignore-whitespace hands back the noise they just filtered out.
                $this->line('  <fg=gray>See what changes: </><fg=green>php artisan blatui:update --diff --dry-run'.($ignoringWhitespace ? ' --ignore-whitespace' : '').'</>');
            }

            return self::SUCCESS;
        }

        $this->components->info("Updated {$written} file(s)".($skipped ? ", kept {$skipped} local version(s)." : '.'));
        $this->line('  <fg=gray>Component stubs only — re-check the CSS/JS foundations with </><fg=green>php artisan blatui:init</>');

        return self::SUCCESS;
    }

    /**
     * Every registry family with at least one file present in the project, mapped
     * to target path => shipped stub path.
     *
     * @return array<string, array<string, string>>
     */
    protected function installedFamilies(Registry $registry): array
    {
        $forcedDest = $this->option('path') ?: null;
        $installed = [];

        foreach (array_keys($registry->manifest()) as $family) {
            $dest = $forcedDest ?? base_path($registry->targetFor($family));
            $files = [];
            $present = false;

            foreach ($registry->filesFor($family) as $src) {
                $target = $dest.'/'.basename($src);
                $files[$target] = $src;
                $present = $present || is_file($target);
            }

            if ($present) {
                $installed[$family] = $files;
            }
        }

        return $installed;
    }

    /**
     * A differing file is either a local customisation or an outdated copy, and
     * nothing on disk distinguishes the two — so never overwrite one silently.
     */
    protected function shouldOverwrite(string $target): bool
    {
        if ($this->option('force')) {
            return true;
        }

        if (! $this->input->isInteractive()) {
            $this->line('  <fg=gray>kept (non-interactive — pass --force to overwrite).</>');

            return false;
        }

        return $this->confirm('  Overwrite this file with the version BlatUI ships?', false);
    }

    protected function write(string $target, string $contents): void
    {
        $dir = dirname($target);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($target, $contents);
    }

    protected function renderDiff(string $local, string $stub, string $label): void
    {
        $diff = Diff::unified($local, $stub, $label.' (yours)', $label.' (registry)');

        foreach (explode("\n", $diff) as $line) {
            // Blade stubs are full of angle brackets — escape before styling, or
            // Symfony reads <div> as a formatter tag.
            $text = OutputFormatter::escape($line);
            $color = match (true) {
                str_starts_with($line, '+') => 'green',
                str_starts_with($line, '-') => 'red',
                str_starts_with($line, '@@') => 'cyan',
                default => 'gray',
            };
            // Straight to the underlying output: Laravel renders $this->line()
            // through Termwind, which collapses runs of whitespace like HTML —
            // and a diff of indented Blade is unreadable without its indentation.
            $this->output->getOutput()->writeln("  <fg={$color}>{$text}</>");
        }
    }

    protected function relative(string $path): string
    {
        $base = base_path();

        return ltrim(str_replace('\\', '/', str_replace($base, '', $path)), '/');
    }
}
