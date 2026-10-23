<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// Where number-input's spinbutton gets its accessible name (issue #47). An aria-label outranks a
// <label for>, so the generic fallback must not be rendered when a label can name the field.
class NumberInputNameTest extends TestCase
{
    private function input(string $blade): string
    {
        preg_match('/<input\s[^>]*role="spinbutton"[^>]*>/s', Blade::render($blade), $input);

        return $input[0];
    }

    public function test_an_id_leaves_the_name_to_a_label_for(): void
    {
        $input = $this->input('<x-ui.number-input id="amount" />');

        $this->assertStringNotContainsString('aria-label=', $input);
        // Without a label pointing at it, the browser gives it the fallback after all.
        $this->assertStringContainsString("x-init=\"\$el.labels?.length || \$el.setAttribute('aria-label', 'Number')\"", $input);
    }

    public function test_an_id_with_a_name_falls_back_to_the_name(): void
    {
        $this->assertStringContainsString("setAttribute('aria-label', 'qty')", $this->input('<x-ui.number-input id="q" name="qty" />'));
    }

    public function test_without_an_id_the_fallback_is_rendered(): void
    {
        $this->assertStringContainsString('aria-label="Number"', $this->input('<x-ui.number-input />'));
        $this->assertStringContainsString('aria-label="qty"', $this->input('<x-ui.number-input name="qty" />'));
    }

    public function test_an_explicit_name_always_wins(): void
    {
        $withId = $this->input('<x-ui.number-input id="amount" aria-label="Amount" />');
        $this->assertStringContainsString('aria-label="Amount"', $withId);
        $this->assertStringNotContainsString('x-init=', $withId);

        $this->assertStringContainsString('aria-labelledby="lbl"', $this->input('<x-ui.number-input id="amount" aria-labelledby="lbl" />'));
    }
}
