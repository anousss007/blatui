<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// The cents-style mask on number-input (issue #41). What it does per keystroke is the engine's
// and the browser suite's job; this locks down that it is opt-in and wired the way it says.
class NumberInputMaskTest extends TestCase
{
    public function test_the_mask_is_off_by_default(): void
    {
        $html = Blade::render('<x-ui.number-input name="qty" />');

        $this->assertStringContainsString('mask: false', $html);
        $this->assertStringContainsString('inputmode="decimal"', $html);
        $this->assertStringNotContainsString('@paste', $html);
        $this->assertStringNotContainsString('data-mask', $html);
    }

    public function test_the_mask_switches_the_keypad_and_listens_for_paste(): void
    {
        $html = Blade::render('<x-ui.number-input name="price" :decimals="2" mask />');

        $this->assertStringContainsString('mask: true', $html);
        $this->assertStringContainsString('inputmode="numeric"', $html);
        $this->assertStringContainsString('@paste="onPaste($event)"', $html);
        $this->assertStringContainsString('data-mask="cents"', $html);
    }

    public function test_a_mask_without_decimals_takes_two_places(): void
    {
        $html = Blade::render('<x-ui.number-input name="price" mask />');

        $this->assertStringContainsString('decimals: 2', $html);
    }

    public function test_an_explicit_decimals_wins_over_the_mask_default(): void
    {
        $html = Blade::render('<x-ui.number-input name="price" :decimals="3" mask />');

        $this->assertStringContainsString('decimals: 3', $html);
    }

    public function test_user_edits_are_announced_as_number_change(): void
    {
        $html = Blade::render('<x-ui.number-input name="qty" />');

        $this->assertStringContainsString("\$dispatch('number-change'", $html);
    }

    public function test_the_linked_fields_example_derives_from_number_change(): void
    {
        $html = Blade::render(file_get_contents(resource_path('views/examples/number-input/linked-fields.blade.php')));

        $this->assertSame(2, substr_count($html, 'x-on:number-change='));
        $this->assertSame(2, substr_count($html, 'data-mask="cents"'));
    }
}
