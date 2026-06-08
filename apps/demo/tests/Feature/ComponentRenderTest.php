<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class ComponentRenderTest extends TestCase
{
    private function render(string $template): string
    {
        return Blade::render($template);
    }

    public function test_card_default_is_a_simple_box(): void
    {
        $html = $this->render('<x-ui.card>hi</x-ui.card>');
        $this->assertStringContainsString('p-6', $html);
        $this->assertStringNotContainsString('flex flex-col gap-6', $html);
    }

    public function test_card_sectioned_restores_flex_layout(): void
    {
        $html = $this->render('<x-ui.card variant="sectioned">hi</x-ui.card>');
        $this->assertStringContainsString('gap-6', $html);
        $this->assertStringContainsString('py-6', $html);
    }

    public function test_badge_tone_emits_semantic_classes(): void
    {
        $html = $this->render('<x-ui.badge tone="success">ok</x-ui.badge>');
        $this->assertStringContainsString('text-success', $html);
    }

    public function test_badge_without_tone_is_unchanged(): void
    {
        $html = $this->render('<x-ui.badge>x</x-ui.badge>');
        $this->assertStringContainsString('bg-primary', $html);
        $this->assertStringContainsString('text-primary-foreground', $html);
    }

    public function test_alert_tone_emits_semantic_classes(): void
    {
        $html = $this->render('<x-ui.alert tone="warning">x</x-ui.alert>');
        $this->assertStringContainsString('text-warning', $html);
    }

    public function test_button_default_type_is_button(): void
    {
        $this->assertStringContainsString('type="button"', $this->render('<x-ui.button>x</x-ui.button>'));
    }

    public function test_button_as_renders_custom_tag_without_type(): void
    {
        $html = $this->render('<x-ui.button as="label">x</x-ui.button>');
        $this->assertStringContainsString('<label', $html);
        $this->assertStringNotContainsString('type="button"', $html);
    }

    public function test_button_before_after_slots_render(): void
    {
        $html = $this->render('<x-ui.button><x-slot:before>BEF</x-slot:before>Label<x-slot:after>AFT</x-slot:after></x-ui.button>');
        $this->assertStringContainsString('BEF', $html);
        $this->assertStringContainsString('AFT', $html);
    }

    public function test_input_size_changes_height(): void
    {
        $this->assertStringContainsString('h-8', $this->render('<x-ui.input size="sm" />'));
        $this->assertStringContainsString('h-10', $this->render('<x-ui.input size="lg" />'));
    }

    public function test_select_native_renders_select_element(): void
    {
        $html = $this->render('<x-ui.select native name="s"><option>a</option></x-ui.select>');
        $this->assertStringContainsString('<select', $html);
        $this->assertStringContainsString('blat-select', $html);
    }

    public function test_checkbox_native_renders_input(): void
    {
        $html = $this->render('<x-ui.checkbox native name="c" />');
        $this->assertStringContainsString('type="checkbox"', $html);
        $this->assertStringContainsString('blat-checkbox', $html);
    }

    public function test_dialog_dispatchable_registers_window_listener(): void
    {
        $html = $this->render('<x-ui.dialog id="demo">y</x-ui.dialog>');
        $this->assertStringContainsString('open-dialog-demo', $html);
        $this->assertStringContainsString('close-dialog-demo', $html);
    }

    public function test_link_renders_inline_anchor(): void
    {
        $html = $this->render('<x-ui.link href="/a">go</x-ui.link>');
        $this->assertStringContainsString('<a', $html);
        $this->assertStringContainsString('text-primary', $html);
    }

    public function test_rating_renders_hidden_input(): void
    {
        $html = $this->render('<x-ui.rating name="r" :value="3" />');
        $this->assertStringContainsString('name="r"', $html);
        $this->assertStringContainsString('data-slot="rating"', $html);
    }

    public function test_date_picker_range_emits_from_to_inputs(): void
    {
        $html = $this->render('<x-ui.date-picker mode="range" name="d" />');
        $this->assertStringContainsString('name="d[from]"', $html);
        $this->assertStringContainsString('name="d[to]"', $html);
    }

    public function test_datetime_picker_range_emits_from_to_inputs(): void
    {
        $html = $this->render('<x-ui.datetime-picker mode="range" name="w" />');
        $this->assertStringContainsString('name="w[from]"', $html);
        $this->assertStringContainsString('name="w[to]"', $html);
    }

    public function test_time_field_input_variant_renders_native_time_input(): void
    {
        $html = $this->render('<x-ui.time-field name="t" variant="input" />');
        $this->assertStringContainsString('type="time"', $html);
    }

    public function test_time_field_select_variant_renders_dropdowns(): void
    {
        $html = $this->render('<x-ui.time-field name="t" variant="select" />');
        $this->assertStringContainsString('<select', $html);
        $this->assertStringNotContainsString('type="time"', $html);
    }

    public function test_datetime_picker_range_with_select_time_renders_dropdowns(): void
    {
        $html = $this->render('<x-ui.datetime-picker mode="range" name="w" time-variant="select" />');
        $this->assertStringContainsString('name="w[from]"', $html);
        $this->assertStringContainsString('<select', $html);
    }

    public function test_datetime_picker_min_max_splits_date_and_time(): void
    {
        $html = $this->render('<x-ui.datetime-picker min="2026-06-10T09:00" max="2026-06-20T17:00" />');
        // Time parts are kept for validation…
        $this->assertStringContainsString("minTime: '09:00'", $html);
        $this->assertStringContainsString("maxTime: '17:00'", $html);
        // …but the calendar only receives the DATE part.
        $this->assertStringContainsString('2026-06-10', $html);
        $this->assertStringNotContainsString('2026-06-10T09:00', $html);
    }

    public function test_datetime_picker_range_length_props_render(): void
    {
        $html = $this->render('<x-ui.datetime-picker mode="range" :min-nights="2" :max-nights="14" />');
        $this->assertStringContainsString('minNights: 2', $html);
        $this->assertStringContainsString('maxNights: 14', $html);
    }

    public function test_date_picker_range_length_prop_renders(): void
    {
        $html = $this->render('<x-ui.date-picker mode="range" :min-nights="3" />');
        $this->assertStringContainsString('minNights: 3', $html);
    }
}
