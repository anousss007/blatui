<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// A component's value travels in data-blat-value, never in its x-data expression (#53, after #48).
// With `:value="$x" wire:model.live="x"` a value in x-data changed the expression on every round
// trip, and Alpine (3.16+) re-applies a changed expression to the live component, resetting all
// of its state: the date-picker closed after the first day of a range, a select lost its labels.
class ValueOutOfXDataTest extends TestCase
{
    public function test_no_component_writes_its_value_into_x_data(): void
    {
        $offenders = [];

        foreach (glob(resource_path('views/components/{ui,block}/*.blade.php'), GLOB_BRACE) as $file) {
            if (preg_match('/\$blatModel\(\s*@js/', file_get_contents($file))) {
                $offenders[] = basename($file);
            }
        }

        $this->assertSame([], $offenders);
    }

    public function test_the_starting_value_is_in_data_blat_value_on_the_x_data_element(): void
    {
        $cases = [
            '<x-ui.date-picker mode="range" :value="[\'from\' => \'2026-10-01\', \'to\' => \'2026-10-05\']" />' => ['date-picker', ['from' => '2026-10-01', 'to' => '2026-10-05']],
            '<x-ui.checkbox :checked="true" />' => ['checkbox', true],
            '<x-ui.tags-input :value="[\'a\', \'b\']" />' => ['tags-input', ['a', 'b']],
            '<x-ui.slider :value="40" />' => ['slider', 40],
        ];

        foreach ($cases as $blade => [$slot, $expected]) {
            $html = Blade::render($blade);
            $this->assertMatchesRegularExpression('/data-blat-value="([^"]*)"\s+x-data="[^"]*\$blatModel\(\)/s', $html, "{$slot}: data-blat-value right before an x-data that reads it");
            preg_match('/data-blat-value="([^"]*)"/', $html, $m);
            $this->assertEquals($expected, json_decode(html_entity_decode($m[1], ENT_QUOTES), true), "{$slot}: the seeded value");
        }
    }
}
