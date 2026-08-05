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

    public function test_calendar_week_start_accepts_name_or_int(): void
    {
        // Extract the weekStart value from the cfg JSON, independent of quote-escaping.
        $grab = fn (string $html): ?string => preg_match('/weekStart.{0,12}?(\d)(?=[,}])/', $html, $m) ? $m[1] : null;

        $this->assertSame('0', $grab($this->render('<x-ui.calendar />')));                    // Sunday default
        $this->assertSame('1', $grab($this->render('<x-ui.calendar week-start="monday" />'))); // name resolves to 1
        $this->assertSame('1', $grab($this->render('<x-ui.date-picker :week-start="1" />')));  // forwarded by the picker
    }

    public function test_date_picker_min_reaches_calendar_as_date_bound(): void
    {
        // min/max are forwarded to the calendar as date bounds (cfg minDate). The two out-of-range
        // modes (disable = struck/unclickable, flag = red + selectable + invalid) are verified
        // in-browser via Playwright (~/pw-debug/oor.js).
        $html = $this->render('<x-ui.date-picker min="2026-06-10" max="2026-06-20" />');
        $this->assertStringContainsString('minDate', $html);
        $this->assertStringContainsString('2026-06-10', $html);
    }

    public function test_calendar_can_hide_outside_days(): void
    {
        // show-outside-days="false" flags the root; CSS hides outside day cells + collapses all-outside rows.
        $this->assertStringNotContainsString('data-hide-outside-days', $this->render('<x-ui.calendar />'));
        $this->assertStringContainsString('data-hide-outside-days', $this->render('<x-ui.date-picker :show-outside-days="false" />'));
    }

    public function test_calendar_exposes_a_controlled_value_binding(): void
    {
        // x-modelable="value" is what lets a parent drive the selection with x-model, instead of
        // keeping the popover mounted just so it can be re-seeded on every open.
        $this->assertStringContainsString('x-modelable="value"', $this->render('<x-ui.calendar />'));
    }

    public function test_calendar_id_becomes_an_addressable_instance_handle(): void
    {
        // The handle lands both on the element (for CSS/queries) and in the Alpine config (so the
        // component can ignore a window-level calendar:* hook aimed at a different instance).
        $html = $this->render('<x-ui.calendar calendar-id="stay" />');
        $this->assertStringContainsString('data-calendar-id="stay"', $html);
        $this->assertStringContainsString('calendarId', $html);

        // A plain id is enough — no need to repeat yourself.
        $this->assertStringContainsString('data-calendar-id="birthday"', $this->render('<x-ui.calendar id="birthday" />'));

        // …and nothing is emitted when neither is given.
        $this->assertStringNotContainsString('data-calendar-id', $this->render('<x-ui.calendar />'));
    }

    public function test_calendar_aria_labels_are_localisable(): void
    {
        // The day aria-label used to hardcode "Today, " / ", selected" regardless of locale.
        $html = $this->render('<x-ui.calendar caption-layout="dropdown" today-label="Aujourd\'hui, :date" selected-label="sélectionné" />');
        $this->assertStringContainsString('Aujourd', $html);
        $this->assertStringContainsString('todayLabel', $html);
        $this->assertStringContainsString('selectedLabel', $html);
    }

    public function test_date_picker_closes_on_a_pick_not_on_a_seed(): void
    {
        // Presets seed the calendar; the seed reports as calendar:updated with a non-'select'
        // source, so the popover stays open without the old `_keepOpen` re-entrancy flag.
        $html = $this->render('<x-ui.date-picker mode="range" :presets="true" />');
        $this->assertStringContainsString('calendar:updated', $html);
        $this->assertStringContainsString("source === 'select'", $html);
        $this->assertStringNotContainsString('_keepOpen', $html);
    }

    public function test_controlled_calendar_example_renders(): void
    {
        // The docs example IS the documentation for the seed/targeting contract — keep it compiling.
        $html = view('examples.calendar.controlled')->render();
        $this->assertStringContainsString('x-model="stay"', $html);
        $this->assertStringContainsString('data-calendar-id="stay"', $html);
        $this->assertStringContainsString('calendar:set-range', $html);
    }

    /**
     * A stray click on the backdrop should not be able to discard a half-filled form.
     * `closeOnOverlay` drops the overlay's click handler — and nothing else: a modal that
     * can't be left from the keyboard is a trap, so Escape stays wired in every case.
     */
    public function test_close_on_overlay_only_governs_the_backdrop_click(): void
    {
        $overlays = [
            'dialog' => '<x-ui.dialog><x-ui.dialog-content %s>x</x-ui.dialog-content></x-ui.dialog>',
            'sheet' => '<x-ui.sheet><x-ui.sheet-content %s>x</x-ui.sheet-content></x-ui.sheet>',
            'drawer' => '<x-ui.drawer><x-ui.drawer-content %s>x</x-ui.drawer-content></x-ui.drawer>',
        ];

        foreach ($overlays as $name => $template) {
            $default = $this->render(sprintf($template, ''));
            $static = $this->render(sprintf($template, ':close-on-overlay="false"'));

            $this->assertStringContainsString(
                '@click="open = false"',
                $this->overlayOf($default, $name),
                "{$name} should close on a backdrop click by default"
            );
            $this->assertStringNotContainsString(
                '@click="open = false"',
                $this->overlayOf($static, $name),
                "{$name} kept the backdrop click handler despite close-on-overlay=false"
            );

            // Escape is the keyboard way out — it survives in both.
            $this->assertStringContainsString('@keydown.escape.window="open = false"', $default);
            $this->assertStringContainsString('@keydown.escape.window="open = false"', $static);
        }

        // dialog and sheet also ship a close (X) button; it is a separate affordance and
        // must not be disabled by proxy. (drawer has none — it slots <x-ui.drawer-close>.)
        foreach (['dialog', 'sheet'] as $name) {
            $static = $this->render(sprintf($overlays[$name], ':close-on-overlay="false"'));

            $this->assertSame(1, substr_count($static, '@click="open = false"'), "{$name} should keep its close button");
            $this->assertStringContainsString('<span class="sr-only">Close</span>', $static);
        }
    }

    /** The overlay element's attributes, up to its data-slot marker. */
    private function overlayOf(string $html, string $component): string
    {
        $at = strpos($html, 'data-slot="'.$component.'-overlay"');
        $this->assertNotFalse($at, "{$component}-overlay is missing");
        $start = strrpos(substr($html, 0, $at), '<div');

        return substr($html, (int) $start, $at - (int) $start);
    }

    /** alert-dialog is the "must decide" modal — it never closed on an outside click. */
    public function test_alert_dialog_still_ignores_the_backdrop_click(): void
    {
        $html = $this->render('<x-ui.alert-dialog><x-ui.alert-dialog-content>x</x-ui.alert-dialog-content></x-ui.alert-dialog>');

        $this->assertStringNotContainsString('@click="open = false"', $html);
        $this->assertStringContainsString('role="alertdialog"', $html);
    }

    /**
     * The toaster used to render a literal class="…" next to a bare {{ $attributes }},
     * so a consumer class produced a second class attribute the browser ignores.
     */
    public function test_sonner_merges_consumer_classes_into_one_attribute(): void
    {
        $html = $this->render('<x-ui.sonner class="print:hidden" />');

        // One class attribute carrying both the base classes and the consumer's.
        $this->assertMatchesRegularExpression('/class="[^"]*print:hidden[^"]*"/', $html);
        preg_match('/class="([^"]*print:hidden[^"]*)"/', $html, $m);
        $this->assertStringContainsString('pointer-events-none', $m[1]);
        $this->assertStringContainsString('sm:max-w-[420px]', $m[1]);
        $this->assertSame(1, substr_count($html, 'print:hidden'));
    }

    /**
     * <x-ui.sidebar>'s collapsible branch dropped the attribute bag entirely — class,
     * id and Alpine bindings passed by a consumer never reached the DOM.
     */
    public function test_sidebar_forwards_attributes_on_every_branch(): void
    {
        $collapsible = $this->render('<x-ui.sidebar-provider><x-ui.sidebar class="print:hidden" id="app-nav">x</x-ui.sidebar></x-ui.sidebar-provider>');
        $this->assertStringContainsString('print:hidden', $collapsible);
        $this->assertStringContainsString('id="app-nav"', $collapsible);
        // The mobile panel mirrors the classes only — a second id would collide.
        $this->assertSame(2, substr_count($collapsible, 'print:hidden'));
        $this->assertSame(1, substr_count($collapsible, 'id="app-nav"'));

        $plain = $this->render('<x-ui.sidebar-provider><x-ui.sidebar collapsible="none" class="print:hidden">x</x-ui.sidebar></x-ui.sidebar-provider>');
        $this->assertStringContainsString('print:hidden', $plain);
    }

    /** Anchored popovers teleport to <body> so an overflow-hidden ancestor never clips them. */
    public function test_anchored_popovers_teleport_to_body(): void
    {
        $this->assertStringContainsString('x-teleport="body"', $this->render('<x-ui.date-picker name="d" />'));
        $this->assertStringContainsString('x-teleport="body"', $this->render('<x-ui.datetime-picker name="dt" />'));
        $this->assertStringContainsString('x-teleport="body"', $this->render('<x-ui.combobox name="c" :options="[\'a\',\'b\']" />'));
    }
}
