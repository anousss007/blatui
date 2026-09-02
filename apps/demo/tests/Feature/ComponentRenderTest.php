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

    /** The value prop normalises to one shape, whatever it was given. #29 */
    public function test_file_upload_value_seeds_the_existing_files(): void
    {
        $html = $this->render('<x-ui.file-upload :value="\'/logos/acme.png\'" />');
        $this->assertStringContainsString('data-blat-value="', $html);
        $this->assertStringContainsString('acme.png', $html);
        $this->assertStringContainsString('&quot;image&quot;:true', $html);
    }

    public function test_file_upload_value_accepts_a_map_and_a_list(): void
    {
        $html = $this->render(
            '<x-ui.file-upload :value="[[\'url\' => \'/a/contract.pdf\', \'name\' => \'Contract\', \'size\' => 1024]]" />'
        );
        $this->assertStringContainsString('&quot;name&quot;:&quot;Contract&quot;', $html);
        $this->assertStringContainsString('&quot;size&quot;:1024', $html);
        // A pdf is not drawn as a thumbnail.
        $this->assertStringContainsString('&quot;image&quot;:false', $html);
    }

    public function test_file_upload_without_value_carries_no_seed(): void
    {
        $html = $this->render('<x-ui.file-upload />');
        // The attribute, not the mention of it in the x-data comment above it.
        $this->assertStringNotContainsString('data-blat-value="', $html);
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
     * twMerge() mutates the bag it is called on. The sidebar renders a desktop root AND a
     * teleported mobile panel from the same $attributes, so merging into the shared bag for
     * the desktop root leaked `hidden md:block` onto the mobile drawer — which then stayed
     * display:none below md, i.e. the drawer never appeared on a phone.
     */
    public function test_sidebar_mobile_panel_does_not_inherit_the_desktop_root_classes(): void
    {
        $html = $this->render('<x-ui.sidebar collapsible="icon" class="print:hidden">x</x-ui.sidebar>');

        $panel = $this->classAttributeNear($html, 'aria-label="Sidebar"');
        $this->assertStringContainsString('flex', $panel, 'the mobile panel must lay out as flex');
        $this->assertStringNotContainsString('md:block', $panel, 'desktop-only classes leaked onto the mobile panel');
        $this->assertDoesNotMatchRegularExpression('/(^| )hidden( |$)/', $panel, 'the mobile drawer must not be display:none');
        $this->assertStringContainsString('print:hidden', $panel, 'the consumer class still reaches the panel');

        // …and the desktop root keeps exactly what it had.
        $desktop = $this->classAttributeNear($html, 'data-slot="sidebar"');
        $this->assertStringContainsString('hidden md:block', $desktop);
        $this->assertStringContainsString('print:hidden', $desktop);
    }

    /**
     * mobile-breakpoint decides `isMobile`, but the panels are painted by CSS. Static `md:`
     * classes alone meant a configured 1023px did nothing between 768px and 1023px: the rail
     * stayed docked and the drawer stayed hidden. The classes remain as the no-JS default —
     * so the rail paints with the page — and `isMobile` overrides them when they disagree.
     */
    public function test_sidebar_panel_visibility_follows_is_mobile_not_only_the_md_breakpoint(): void
    {
        $html = $this->render('<x-ui.sidebar collapsible="icon">x</x-ui.sidebar>');

        // Desktop root: CSS default kept, overridden when isMobile disagrees with it.
        $this->assertStringContainsString('hidden md:block', $html);
        $this->assertStringContainsString("{ 'md:hidden!': isMobile }", $html);

        // The drawer is gated on isMobile itself, so a breakpoint above md still gets it.
        $this->assertStringContainsString('x-show="openMobile && isMobile"', $html);
        $wrapper = $this->classAttributeNear($html, 'x-show="openMobile && isMobile"');
        $this->assertStringNotContainsString('md:hidden', $wrapper, 'the drawer wrapper must not be pinned to md');
    }

    /** Off-canvas below md by default; raise it to get the drawer on tablets too. */
    public function test_sidebar_mobile_breakpoint_is_configurable(): void
    {
        $this->assertStringContainsString(
            "matchMedia('(max-width: 767px)')",
            $this->render('<x-ui.sidebar-provider>x</x-ui.sidebar-provider>')
        );
        $this->assertStringContainsString(
            "matchMedia('(max-width: 1023px)')",
            $this->render('<x-ui.sidebar-provider mobile-breakpoint="1023px">x</x-ui.sidebar-provider>')
        );
        // A bare number is read as px.
        $this->assertStringContainsString(
            "matchMedia('(max-width: 900px)')",
            $this->render('<x-ui.sidebar-provider :mobile-breakpoint="900">x</x-ui.sidebar-provider>')
        );
    }

    /** The class attribute of the element carrying $marker. */
    private function classAttributeNear(string $html, string $marker): string
    {
        $at = strpos($html, $marker);
        $this->assertNotFalse($at, "{$marker} not found");
        $tag = substr($html, (int) strrpos(substr($html, 0, $at), '<'));
        preg_match('/class="([^"]*)"/', $tag, $m);

        return $m[1] ?? '';
    }

    /** Collapsed to the icon rail a menu button shows only its icon — `tooltip` names it. */
    public function test_sidebar_menu_button_tooltip_is_opt_in_and_gated_on_the_collapsed_rail(): void
    {
        $plain = $this->render('<x-ui.sidebar-menu-button href="#"><span>Home</span></x-ui.sidebar-menu-button>');
        $this->assertStringNotContainsString('sidebar-menu-button-tooltip', $plain);
        $this->assertStringNotContainsString('tooltip-content', $plain);

        $tipped = $this->render('<x-ui.sidebar-menu-button href="#" tooltip="Home"><span>Home</span></x-ui.sidebar-menu-button>');
        $this->assertStringContainsString('data-slot="sidebar-menu-button-tooltip"', $tipped);
        $this->assertStringContainsString('data-side="right"', $tipped);
        // Only while the rail is collapsed, and read defensively so a button rendered
        // outside a provider doesn't spam ReferenceErrors.
        $this->assertStringContainsString('tipOpen &amp;&amp; $data.collapsed', $tipped);
    }

    /**
     * menu-action / menu-badge style themselves off the `peer-hover/menu-button` and
     * `peer-data-[active=true]/menu-button` variants, which need the button to be their
     * previous sibling — wrapping it for the tooltip would silently break that, so the
     * wrapper carries the peer identity (and the active state those variants key off).
     */
    public function test_tooltip_wrapper_keeps_the_menu_button_peer_relationship(): void
    {
        $html = $this->render('<x-ui.sidebar-menu-item><x-ui.sidebar-menu-button tooltip="Home" is-active>x</x-ui.sidebar-menu-button><x-ui.sidebar-menu-action>a</x-ui.sidebar-menu-action></x-ui.sidebar-menu-item>');

        $wrapper = substr($html, (int) strpos($html, 'data-slot="sidebar-menu-button-tooltip"'));
        $wrapper = substr($wrapper, 0, (int) strpos($wrapper, '>'));
        $this->assertStringContainsString('peer/menu-button', $wrapper);
        $this->assertStringContainsString('data-active="true"', $wrapper);
    }

    /**
     * Alpine resolves a getter's `this` against the scope that READS it, so a `collapsed`
     * getter on the provider would pick up the `open` of the tooltip or collapsible the
     * reader sits in — inverted, silently, in our own sidebar-07 block. Two guards: the
     * provider keeps a plain synced property, and the tooltip wrapper never introduces
     * an `open` of its own (the menu button drives its collapsible with `open = !open`).
     */
    public function test_collapsed_state_survives_nested_alpine_scopes(): void
    {
        $provider = $this->render('<x-ui.sidebar-provider>x</x-ui.sidebar-provider>');
        $this->assertStringContainsString('collapsed: false', $provider);
        $this->assertStringContainsString('x-effect="collapsed = !isMobile && !open"', $provider);
        $this->assertStringNotContainsString('get collapsed', $provider);

        $tipped = $this->render('<x-ui.sidebar-menu-button tooltip="Home">x</x-ui.sidebar-menu-button>');
        $this->assertStringContainsString('x-data="{ tipOpen: false }"', $tipped);

        // The shipped block composes collapsible + tooltip around the same button.
        $block = $this->render('<x-block.nav-main :items="[[\'title\' => \'Home\', \'icon\' => \'house\', \'items\' => []]]" />');
        $this->assertStringContainsString('x-on:click="open = !open"', $block);
        $this->assertStringContainsString('data-slot="sidebar-menu-button-tooltip"', $block);
        $this->assertStringNotContainsString('open: false, tipOpen', $block);
    }

    /** Collapsed, the list must still scroll — and the scrollbar must not eat the rail. */
    public function test_sidebar_content_scrolls_when_collapsed_without_stealing_rail_width(): void
    {
        $html = $this->render('<x-ui.sidebar-content>x</x-ui.sidebar-content>');

        $this->assertStringContainsString('overflow-auto', $html);
        $this->assertStringContainsString('group-data-[collapsible=icon]:overflow-x-hidden', $html);
        // The vertical clip is what made the last groups unreachable.
        $this->assertStringNotContainsString('group-data-[collapsible=icon]:overflow-hidden', $html);
        // A classic scrollbar would take ~16px out of a 3rem rail; hide it instead of widening.
        $this->assertStringContainsString('group-data-[collapsible=icon]:[scrollbar-width:none]', $html);
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
