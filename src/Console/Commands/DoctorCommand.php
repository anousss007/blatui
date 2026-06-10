<?php

namespace BlatUI\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class DoctorCommand extends Command
{
    protected $signature = 'blatui:doctor {path? : Directory of Blade views to scan (defaults to resources/views)}
        {--compiled= : Directory of compiled views to scan for leaked tags (defaults to the framework view cache)}';

    protected $description = 'Scan for common BlatUI footguns: an <x-ui.button> in a <form> with no type (renders type=button, will not submit), and <x-ui.*> tags that leaked into compiled HTML (failed to compile — e.g. nested in an @aware slot)';

    public function handle(): int
    {
        $base = $this->argument('path') ?: resource_path('views');

        if (! is_dir($base)) {
            $this->components->error("Not a directory: {$base}");

            return self::FAILURE;
        }

        // --- Check 1: typeless <x-ui.button> inside a <form> (source scan) ---
        $buttonFindings = [];
        $scanned = 0;
        foreach ((new Finder)->files()->in($base)->name('*.blade.php') as $file) {
            $scanned++;
            $buttonFindings = array_merge($buttonFindings, $this->scanButtons($file->getRealPath(), $file->getContents()));
        }

        // --- Check 2: literal <x-ui.*> that leaked into compiled HTML (compiled-view scan) ---
        $literalFindings = $this->scanCompiledViews();

        $total = count($buttonFindings) + count($literalFindings);

        if ($total === 0) {
            $this->components->info("Scanned {$scanned} Blade file(s) — no BlatUI footguns found.");

            return self::SUCCESS;
        }

        $this->components->warn($total.' potential issue(s) found:');
        $this->newLine();

        if (! empty($buttonFindings)) {
            $this->line('  <options=bold>Typeless buttons in a form</> — render type="button" and will NOT submit:');
            foreach ($buttonFindings as $f) {
                $this->line("  <fg=yellow>⚠</>  <fg=gray>{$f['file']}:{$f['line']}</>");
                $this->line("      {$f['message']}");
            }
            $this->line('  <options=bold>Fix:</> add <fg=green>type="submit"</> to the form\'s submit button (or <fg=green>type="button"</> if it is an action button).');
            $this->line('  <fg=gray>BlatUI buttons default to type="button" (a deliberate default); a migrated native submit button can silently stop submitting.</>');
            $this->newLine();
        }

        if (! empty($literalFindings)) {
            $this->line('  <options=bold>Un-compiled &lt;x-ui.*&gt; tags in compiled HTML</> — the field/element is silently absent:');
            foreach ($literalFindings as $f) {
                $this->line("  <fg=yellow>⚠</>  <fg=gray>{$f['file']}:{$f['line']}</>  <fg=red>{$f['tag']}</>");
            }
            $this->line('  <options=bold>Fix:</> a &lt;x-ui.*&gt; left literal in the output failed to compile — usually because it was passed as the');
            $this->line('  <fg=gray>slot content of an @aware anonymous component that re-wraps the slot. In that DX layer, render a raw</>');
            $this->line('  <fg=gray>element styled by a foundations utility instead: </><fg=green>.blat-input .blat-textarea .blat-select .blat-checkbox .blat-radio</>');
            $this->line('  <fg=gray>This passes GET/feature tests (page still renders 200) — only a browser test that fills the field catches it.</>');
            $this->newLine();
        }

        return self::FAILURE;
    }

    /**
     * @return array<int, array{file: string, line: int, message: string}>
     */
    private function scanButtons(string $path, string $content): array
    {
        $findings = [];

        // Don't flag tags that only appear inside comments (e.g. a note explaining why a
        // component is NOT used here). Masking preserves offsets so line numbers stay accurate.
        $content = $this->maskComments($content);

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

    /**
     * Blank out comment bodies (Blade, HTML, and PHP/JS block + line comments) by replacing them
     * with same-length whitespace. Offsets and line numbers are preserved, so a <x-ui.*> mentioned
     * only inside a comment no longer triggers a false positive. The // pattern skips URLs (://).
     */
    private function maskComments(string $content): string
    {
        $patterns = [
            '/\{\{--.*?--\}\}/s',      // Blade comments
            '/<!--.*?-->/s',           // HTML comments
            '/\/\*.*?\*\//s',          // block comments
            '/(?<![:\/])\/\/[^\n]*/',  // line comments (not part of a URL)
        ];

        foreach ($patterns as $re) {
            $content = preg_replace_callback(
                $re,
                fn ($m) => preg_replace('/[^\n]/', ' ', $m[0]),
                $content
            ) ?? $content;
        }

        return $content;
    }

    /**
     * Scan the compiled view cache for literal <x-ui.*> tags. A component tag that reaches the
     * compiled PHP un-transformed means it failed to compile (commonly: nested as slot content of
     * an @aware anonymous component). HTML-encoded references in docs (&lt;x-ui...) won't match.
     *
     * @return array<int, array{file: string, line: int, tag: string}>
     */
    private function scanCompiledViews(): array
    {
        $dir = $this->option('compiled')
            ?: (function_exists('storage_path') ? storage_path('framework/views') : null);
        if (! $dir || ! is_dir($dir)) {
            return [];
        }

        $findings = [];
        foreach ((new Finder)->files()->in($dir)->name('*.php') as $file) {
            // Mask comments first so a <x-ui.*> mentioned in an HTML/PHP comment isn't a false hit.
            $content = $this->maskComments($file->getContents());
            if (stripos($content, '<x-ui.') === false) {
                continue;
            }
            if (! preg_match_all('/<x-ui\.[a-z0-9.\-]+/i', $content, $matches, PREG_OFFSET_CAPTURE)) {
                continue;
            }
            $relative = str_replace(base_path().DIRECTORY_SEPARATOR, '', $file->getRealPath());
            foreach ($matches[0] as [$tag, $offset]) {
                $line = substr_count(substr($content, 0, $offset), "\n") + 1;
                $findings[] = ['file' => $relative, 'line' => $line, 'tag' => $tag.'…'];
            }
        }

        return $findings;
    }
}
