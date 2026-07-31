<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * The starter's pre-built pages must render end-to-end — every <x-ui.*>, <x-block.*> and
 * <x-layouts.app> they compose has to resolve. This is the regression guard for the
 * "Unable to locate ... component [block.nav-user]" class of failure (GitHub issue #1):
 * a stale starter that dropped components would throw here.
 *
 * The base TestCase stubs the Vite manifest so the pages render without a frontend build.
 */
class PagesRenderTest extends TestCase
{
    public function test_landing_page_renders(): void
    {
        $res = $this->get('/');
        $res->assertOk();
        $res->assertSee('BlatUI', false);
    }

    public function test_dashboard_renders_with_sidebar_and_block_components(): void
    {
        $res = $this->get('/dashboard');
        $res->assertOk();
        // Block components composed by the dashboard must have rendered (not thrown).
        $res->assertSee('m@example.com', false);           // nav-user footer
        $res->assertSee('data-slot="sidebar"', false);      // sidebar block
    }

    public function test_auth_pages_render(): void
    {
        $this->get('/login')->assertOk()->assertSee('Login to your account', false);
        $this->get('/register')->assertOk()->assertSee('Create an account', false);
    }

    public function test_no_unresolved_blade_component_tags_leak_into_output(): void
    {
        // A component Blade fails to locate compiles to a literal "<x-…>" in the output.
        foreach (['/', '/dashboard', '/login', '/register'] as $uri) {
            $html = $this->get($uri)->assertOk()->getContent();
            $this->assertDoesNotMatchRegularExpression(
                '/<x-(ui|block|layouts)\./',
                $html,
                "Unresolved BlatUI component tag leaked into {$uri}"
            );
        }
    }
}
