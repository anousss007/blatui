<?php

namespace Tests\Feature;

use Tests\TestCase;

class ThemeEditorTest extends TestCase
{
    public function test_theme_editor_page_renders_with_controls_and_preview(): void
    {
        $res = $this->get('/themes');

        $res->assertOk();
        $res->assertSee('Theme editor');
        // Controls partial.
        $res->assertSee('Base color');
        $res->assertSee('Accent');
        // Live preview gallery (exercises the x-ui components).
        $res->assertSee('Buttons');
        // Actions are wired to the theme store + export.
        $res->assertSee('Copy CSS');
        $res->assertSee('Share link');
    }

    public function test_themes_is_listed_in_the_sitemap(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee('/themes');
    }

    public function test_header_links_to_the_theme_editor(): void
    {
        // The shared header (on any page) exposes the Themes destination.
        $this->get('/')->assertOk()->assertSee('/themes');
    }
}
