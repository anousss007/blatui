<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Lang;
use Tests\TestCase;

/**
 * Registry components must not hardcode English UI strings and must use logical
 * (start/end) direction utilities so they work under RTL. Guards the blat-ui-feedback
 * items on i18n and RTL. See also the calendar selection-repaint keys below.
 */
class RegistryI18nRtlTest extends TestCase
{
    private function render(string $template): string
    {
        return Blade::render($template);
    }

    /** Register a JSON-string translation (the form `__('Some text')` resolves). */
    private function translate(string $key, string $value, string $locale = 'fr'): void
    {
        Lang::addLines(["*.{$key}" => $value], $locale, '*');
    }

    public function test_pagination_prev_next_default_labels_go_through_translator(): void
    {
        $prev = $this->render('<x-ui.pagination-previous />');
        $this->assertStringContainsString('Previous', $prev);
        $this->assertStringContainsString('Go to previous page', $prev);

        $next = $this->render('<x-ui.pagination-next />');
        $this->assertStringContainsString('Next', $next);
        $this->assertStringContainsString('Go to next page', $next);
    }

    public function test_pagination_labels_are_translatable(): void
    {
        $this->translate('Previous', 'Précédent');
        $this->translate('Go to previous page', 'Aller à la page précédente');
        app()->setLocale('fr');

        $prev = $this->render('<x-ui.pagination-previous />');
        $this->assertStringContainsString('Précédent', $prev);
        $this->assertStringContainsString('Aller à la page précédente', $prev);
        $this->assertStringNotContainsString('>Previous<', $prev);
    }

    public function test_pagination_label_prop_overrides_default(): void
    {
        $prev = $this->render('<x-ui.pagination-previous label="Vorige" aria-label="Ga terug" />');
        $this->assertStringContainsString('Vorige', $prev);
        $this->assertStringContainsString('Ga terug', $prev);
    }

    public function test_sidebar_trigger_label_is_translatable_and_overridable(): void
    {
        $this->translate('Toggle Sidebar', 'Basculer la barre');
        app()->setLocale('fr');

        $html = $this->render('<x-ui.sidebar-provider><x-ui.sidebar-trigger /></x-ui.sidebar-provider>');
        $this->assertStringContainsString('Basculer la barre', $html);

        app()->setLocale('en');
        $custom = $this->render('<x-ui.sidebar-provider><x-ui.sidebar-trigger label="Menu" /></x-ui.sidebar-provider>');
        $this->assertStringContainsString('aria-label="Menu"', $custom);
    }

    public function test_calendar_month_nav_labels_are_translatable_and_overridable(): void
    {
        $default = $this->render('<x-ui.calendar />');
        $this->assertStringContainsString('Go to the previous month', $default);
        $this->assertStringContainsString('Go to the next month', $default);

        $custom = $this->render('<x-ui.calendar prev-month-label="Mois précédent" next-month-label="Mois suivant" />');
        $this->assertStringContainsString('Mois précédent', $custom);
        $this->assertStringContainsString('Mois suivant', $custom);
        $this->assertStringNotContainsString('Go to the previous month', $custom);
    }

    /**
     * The selection-repaint fix: day cells must be keyed by their date (content-stable),
     * not by the positional loop index, so a month navigation mounts fresh cells whose
     * :data-selected binding re-evaluates against the current selection.
     */
    public function test_calendar_grid_uses_content_stable_keys(): void
    {
        $cal = $this->render('<x-ui.calendar />');
        $this->assertStringContainsString(':key="fmt(day)"', $cal);
        $this->assertStringContainsString(':key="fmt(week[0])"', $cal);
        $this->assertStringContainsString(':key="fmt(m)"', $cal);
        $this->assertStringNotContainsString(':key="di"', $cal);
        $this->assertStringNotContainsString(':key="wi"', $cal);
    }

    public function test_registry_components_use_logical_direction_utilities(): void
    {
        $cases = [
            ['<x-ui.select-item value="a">A</x-ui.select-item>', ['pe-8 ps-2', 'end-2'], ['pr-8 pl-2']],
            ['<x-ui.menu-checkbox-item>C</x-ui.menu-checkbox-item>', ['pe-2 ps-8', 'start-2'], ['pr-2 pl-8']],
            ['<x-ui.menu-radio-item value="x">R</x-ui.menu-radio-item>', ['pe-2 ps-8', 'start-2'], ['pr-2 pl-8']],
            ['<x-ui.toggle-group><x-ui.toggle-group-item value="a">A</x-ui.toggle-group-item></x-ui.toggle-group>', ['rounded-s-md', 'rounded-e-md', 'border-s-0'], ['rounded-l-md', 'rounded-r-md']],
            ['<x-ui.input-group-addon>@</x-ui.input-group-addon>', ['ps-3'], ['pl-3']],
        ];

        foreach ($cases as [$template, $expected, $forbidden]) {
            $html = $this->render($template);
            foreach ($expected as $needle) {
                $this->assertStringContainsString($needle, $html, "expected logical utility [$needle] in {$template}");
            }
            foreach ($forbidden as $needle) {
                $this->assertStringNotContainsString($needle, $html, "physical utility [$needle] should be gone from {$template}");
            }
        }
    }
}
