<?php

namespace BlatUI\Tests;

/**
 * The theme editor's "Copy CSS" hands the user a file meant to *replace* their
 * app.css. Two things silently break that promise, and neither shows up until
 * someone flips to dark mode or looks at a heading:
 *
 *  1. THEME_SCAFFOLD in blatui-core.js re-types the @theme inline mapping by
 *     hand — when app.css gains a token there, the export stops generating the
 *     matching utility (bg-success, font-heading…).
 *  2. THEME_TOKENS lists what gets written into :root/.dark — a token missing
 *     from it silently inherits the neutral default instead of the theme's.
 *
 * Both are drift, not logic, so they are guarded here rather than reviewed.
 */
class ThemeExportTest extends TestCase
{
    private function css(): string
    {
        return (string) file_get_contents(dirname(__DIR__).'/stubs/foundations/app.css');
    }

    private function core(): string
    {
        return (string) file_get_contents(dirname(__DIR__).'/stubs/foundations/blatui-core.js');
    }

    /** Extract a brace-balanced block starting at the first occurrence of $opener. */
    private function block(string $source, string $opener): string
    {
        $start = strpos($source, $opener);
        $this->assertNotFalse($start, "Could not find {$opener}");

        $i = strpos($source, '{', $start);
        $depth = 0;
        for ($k = $i; $k < strlen($source); $k++) {
            if ($source[$k] === '{') {
                $depth++;
            } elseif ($source[$k] === '}') {
                $depth--;
                if ($depth === 0) {
                    return substr($source, $start, $k - $start + 1);
                }
            }
        }

        $this->fail("Unbalanced braces after {$opener}");
    }

    /** @return list<string> */
    private function exportedTokens(): array
    {
        $core = $this->core();
        preg_match('/const THEME_TOKENS = \[(.*?)\];/s', $core, $m);
        $this->assertNotEmpty($m, 'THEME_TOKENS is missing from blatui-core.js');
        preg_match_all("/'(--[a-z0-9-]+)'/", $m[1], $tokens);

        return $tokens[1];
    }

    public function test_the_exported_scaffold_mirrors_the_theme_mapping_in_app_css(): void
    {
        preg_match('/const THEME_SCAFFOLD = `(.*?)`;/s', $this->core(), $m);
        $this->assertNotEmpty($m, 'THEME_SCAFFOLD is missing from blatui-core.js');

        $this->assertSame(
            $this->block($this->css(), '@theme inline'),
            $this->block($m[1], '@theme inline'),
            'THEME_SCAFFOLD has drifted from app.css — exported themes would lose the utilities added there.'
        );
    }

    public function test_every_token_the_theme_mapping_reads_is_exported(): void
    {
        preg_match_all('/var\((--[a-z0-9-]+)\)/', $this->block($this->css(), '@theme inline'), $m);
        $exported = $this->exportedTokens();

        foreach (array_unique($m[1]) as $token) {
            $this->assertContains($token, $exported, "{$token} is mapped by @theme inline but never exported.");
        }
    }

    public function test_every_root_token_is_exported(): void
    {
        preg_match_all('/^\s*(--[a-z0-9-]+)\s*:/m', $this->block($this->css(), "\n:root"), $m);
        $exported = $this->exportedTokens();

        $this->assertNotEmpty($m[1]);
        foreach (array_unique($m[1]) as $token) {
            $this->assertContains($token, $exported, "{$token} is declared in :root but dropped from the theme export.");
        }
    }

    /**
     * Regression guard for the tokens that were actually missing: the status
     * palette and the heading font (which the editor itself lets you change).
     */
    public function test_status_and_heading_tokens_are_exported(): void
    {
        $exported = $this->exportedTokens();

        foreach ([
            '--font-heading',
            '--success', '--success-foreground',
            '--warning', '--warning-foreground',
            '--info', '--info-foreground',
        ] as $token) {
            $this->assertContains($token, $exported);
        }
    }
}
