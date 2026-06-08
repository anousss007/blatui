<?php

namespace BlatUI\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class DoctorCommand extends Command
{
    protected $signature = 'blatui:doctor {path? : Directory to scan (defaults to resources/views)}';

    protected $description = 'Scan Blade views for common BlatUI footguns (e.g. an <x-ui.button> in a <form> with no type — it renders type=button and will not submit)';

    public function handle(): int
    {
        $base = $this->argument('path') ?: resource_path('views');

        if (! is_dir($base)) {
            $this->components->error("Not a directory: {$base}");

            return self::FAILURE;
        }

        $finder = (new Finder)->files()->in($base)->name('*.blade.php');

        $findings = [];
        $scanned = 0;

        foreach ($finder as $file) {
            $scanned++;
            $findings = array_merge($findings, $this->scanFile($file->getRealPath(), $file->getContents()));
        }

        if (empty($findings)) {
            $this->components->info("Scanned {$scanned} Blade file(s) — no BlatUI footguns found.");

            return self::SUCCESS;
        }

        $this->components->warn(count($findings).' potential issue(s) across '.$scanned.' Blade file(s):');
        $this->newLine();

        foreach ($findings as $f) {
            $this->line("  <fg=yellow>⚠</>  <fg=gray>{$f['file']}:{$f['line']}</>");
            $this->line("      {$f['message']}");
        }

        $this->newLine();
        $this->line('  <options=bold>Fix:</> add <fg=green>type="submit"</> to the form\'s submit button (or <fg=green>type="button"</> if it is an action button).');
        $this->line('  <fg=gray>BlatUI buttons default to type="button" (shadcn-aligned). A native <button> inside a</>');
        $this->line('  <fg=gray>form defaults to submit, so submit buttons migrated from native markup can silently stop</>');
        $this->line('  <fg=gray>submitting with no error. This check does not fail your build — review each finding.</>');

        return self::FAILURE;
    }

    /**
     * @return array<int, array{file: string, line: int, message: string}>
     */
    private function scanFile(string $path, string $content): array
    {
        $findings = [];

        if (! preg_match_all('/<x-ui\.button\b[^>]*>/s', $content, $matches, PREG_OFFSET_CAPTURE)) {
            return $findings;
        }

        $relative = str_replace(base_path().DIRECTORY_SEPARATOR, '', $path);

        foreach ($matches[0] as [$tag, $offset]) {
            $before = substr($content, 0, $offset);

            // Only flag buttons inside an open <form> (forms can't nest, so a simple
            // open/close count before the button is sufficient).
            $openForms = preg_match_all('/<form\b/i', $before);
            $closedForms = preg_match_all('#</form>#i', $before);
            if ($openForms <= $closedForms) {
                continue;
            }

            // Safe if it already declares a type, is a link, or carries a click/submit
            // handler (then type=button is intentional / it isn't the submit button).
            if (preg_match('/\btype\s*=/i', $tag)) {
                continue;
            }
            if (preg_match('/\bhref\s*=|:href\s*=/i', $tag)) {
                continue;
            }
            if (preg_match('/@click|x-on:click|wire:click|wire:submit|onclick/i', $tag)) {
                continue;
            }

            $line = substr_count($before, "\n") + 1;
            $findings[] = [
                'file' => $relative,
                'line' => $line,
                'message' => '<x-ui.button> inside a <form> has no type — it renders type="button" and will NOT submit the form.',
            ];
        }

        return $findings;
    }
}
