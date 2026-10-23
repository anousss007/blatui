<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// A consumer's x-init on a component whose element already carries one of its own (issue #46).
// The bag was echoed next to the component's attribute, so the element ended up with two x-init
// attributes, and an HTML parser keeps the first: the consumer's code never ran, without an error.
class ConsumerXInitTest extends TestCase
{
    /** Every x-init attribute on the first tag in $html that matches $tagPattern. */
    private function xInits(string $html, string $tagPattern): array
    {
        $this->assertMatchesRegularExpression($tagPattern, $html);
        preg_match($tagPattern, $html, $tag);
        preg_match_all('/(?<![\w:-])x-init="([^"]*)"/', $tag[0], $inits);

        return array_map(fn ($i) => html_entity_decode($i, ENT_QUOTES), $inits[1]);
    }

    public function test_a_button_combobox_runs_both_its_own_and_the_consumer_x_init(): void
    {
        $html = Blade::render('<x-ui.combobox :options="[]" x-init="window.seen = true" />');
        $inits = $this->xInits($html, '/<div\s[^>]*data-slot="combobox"[^>]*>/s');

        $this->assertCount(1, $inits);
        $this->assertStringContainsString('ensureActive()', $inits[0]);
        $this->assertStringEndsWith('; window.seen = true', $inits[0]);
    }

    public function test_an_input_combobox_keeps_the_consumer_x_init_alone(): void
    {
        $html = Blade::render('<x-ui.combobox trigger="input" :options="[]" x-init="window.seen = true" />');

        $this->assertSame(['window.seen = true'], $this->xInits($html, '/<div\s[^>]*data-slot="combobox"[^>]*>/s'));
    }

    public function test_a_combobox_without_one_renders_only_its_own(): void
    {
        $this->assertSame(
            ["\$watch('query', () => ensureActive())"],
            $this->xInits(Blade::render('<x-ui.combobox :options="[]" />'), '/<div\s[^>]*data-slot="combobox"[^>]*>/s'),
        );
        $this->assertSame([], $this->xInits(
            Blade::render('<x-ui.combobox trigger="input" :options="[]" />'),
            '/<div\s[^>]*data-slot="combobox"[^>]*>/s',
        ));
    }

    public function test_triggers_and_items_keep_the_consumer_x_init(): void
    {
        $cases = [
            'select-trigger' => ['<x-ui.select-trigger x-init="window.seen = true">x</x-ui.select-trigger>', '_trigger = $el'],
            'context-menu-trigger' => ['<x-ui.context-menu-trigger x-init="window.seen = true">x</x-ui.context-menu-trigger>', '_trigger = $el'],
            'dropdown-menu-trigger' => ['<x-ui.dropdown-menu-trigger x-init="window.seen = true">x</x-ui.dropdown-menu-trigger>', '_trigger = $el'],
            'menubar-trigger' => ['<x-ui.menubar-trigger x-init="window.seen = true">x</x-ui.menubar-trigger>', 'register(id, $el)'],
            'command-item' => ['<x-ui.command-item x-init="window.seen = true">x</x-ui.command-item>', 'registerItem($el'],
        ];

        foreach ($cases as $slot => [$blade, $own]) {
            $inits = $this->xInits(Blade::render($blade), '/<\w+\s[^>]*data-slot="'.$slot.'"[^>]*>/s');

            $this->assertCount(1, $inits, "{$slot} renders one x-init");
            $this->assertStringContainsString($own, $inits[0], "{$slot} keeps its own x-init");
            $this->assertStringEndsWith('; window.seen = true', $inits[0], "{$slot} runs the consumer's after it");
        }
    }

    /**
     * Static guard for every component, so a new one cannot bring the bug back: an element that
     * writes an x-init of its own and also echoes the attribute bag must take x-init out of the
     * bag first. Component tags (<x-…>) are left alone — their x-init is handled inside them.
     */
    public function test_no_component_echoes_an_x_init_next_to_its_own(): void
    {
        $offenders = [];

        foreach (glob(resource_path('views/components/{ui,block}/*.blade.php'), GLOB_BRACE) as $file) {
            $source = file_get_contents($file);
            preg_match_all('/<(?!x-)[a-zA-Z][^<>]*?(?:\{\{[^}]*\}\}|[^<>])*?>/s', $source, $tags);

            foreach ($tags[0] as $tag) {
                if (preg_match('/(?<![\w:-])x-init=/', $tag) && str_contains($tag, '$attributes') && ! str_contains($source, "except('x-init')")) {
                    $offenders[] = basename($file);
                }
            }
        }

        $this->assertSame([], array_values(array_unique($offenders)));
    }
}
