<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// Month names, weekdays and dates follow a locale the picker forwards to its calendar (#52).
class DatePickerLocaleTest extends TestCase
{
    /** The `locale` in the calendar's config, as the browser will receive it. */
    private function calendarLocale(string $html): ?string
    {
        // Js::from() renders JSON.parse('…') with every quote as \u0022.
        preg_match("/x-data=\"calendar\\(JSON\\.parse\\('(.*?)'\\)\\)\"/s", $html, $m);
        $json = json_decode('"'.html_entity_decode($m[1] ?? '', ENT_QUOTES).'"');

        return json_decode((string) $json, true)['locale'] ?? null;
    }

    public function test_a_date_picker_forwards_its_locale_to_the_calendar_and_the_label(): void
    {
        foreach (['date-picker', 'datetime-picker'] as $picker) {
            $html = Blade::render("<x-ui.{$picker} locale=\"es\" />");

            $this->assertSame('es', $this->calendarLocale($html), "{$picker}: the calendar's locale");
            $this->assertStringContainsString('locale: $blatLocale(\'es\')', html_entity_decode($html, ENT_QUOTES), "{$picker}: the trigger label's locale");
        }
    }

    public function test_without_one_the_calendar_follows_the_app_locale_as_a_bcp47_tag(): void
    {
        App::setLocale('pt_BR');

        $this->assertSame('pt-BR', $this->calendarLocale(Blade::render('<x-ui.calendar />')));
        $this->assertSame('pt-BR', $this->calendarLocale(Blade::render('<x-ui.date-picker />')));
    }
}
