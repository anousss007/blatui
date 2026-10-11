<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// The remembered expanded/collapsed state (issue #39). The cookie is read on the server so the
// first paint is already right; these lock down that the provider AND the panel agree on it, and
// that nothing changes for an app that did not opt in.
class SidebarPersistTest extends TestCase
{
    private const SIDEBAR = '<x-ui.sidebar-provider %s><x-ui.sidebar collapsible="icon">x</x-ui.sidebar></x-ui.sidebar-provider>';

    private function renderWithCookie(string $providerProps, ?string $cookie): string
    {
        $server = $cookie === null ? [] : ['HTTP_COOKIE' => $cookie];
        $this->app->instance('request', Request::create('/', 'GET', [], [], [], $server));

        return Blade::render(sprintf(self::SIDEBAR, $providerProps));
    }

    public function test_without_persist_the_cookie_is_ignored_and_never_written(): void
    {
        $html = $this->renderWithCookie('', 'sidebar_state=false');

        $this->assertStringContainsString('open: true', $html);
        $this->assertStringContainsString('data-state="expanded"', $html);
        $this->assertStringNotContainsString('document.cookie', $html);
    }

    public function test_a_remembered_collapse_paints_collapsed_on_the_server(): void
    {
        $html = $this->renderWithCookie('persist', 'theme=dark; sidebar_state=false');

        $this->assertStringContainsString('open: false', $html);
        $this->assertStringContainsString('data-state="collapsed"', $html);
        $this->assertStringContainsString('data-collapsible="icon"', $html);
        $this->assertStringContainsString('style="width: var(--sidebar-width-icon)"', $html);
        $this->assertStringContainsString("'sidebar_state'", $html);
    }

    public function test_the_cookie_wins_over_default_open(): void
    {
        $html = $this->renderWithCookie(':default-open="false" persist', 'sidebar_state=true');

        $this->assertStringContainsString('open: true', $html);
        $this->assertStringContainsString('data-state="expanded"', $html);
    }

    public function test_no_cookie_yet_falls_back_to_default_open(): void
    {
        $html = $this->renderWithCookie(':default-open="false" persist', null);

        $this->assertStringContainsString('open: false', $html);
        $this->assertStringContainsString('data-state="collapsed"', $html);
    }

    public function test_a_named_cookie_reads_only_its_own_name(): void
    {
        $html = $this->renderWithCookie('persist="admin_sidebar"', 'sidebar_state=false; admin_sidebar=true');
        $this->assertStringContainsString('open: true', $html);
        $this->assertStringContainsString("'admin_sidebar'", $html);

        $html = $this->renderWithCookie('persist="admin_sidebar"', 'sidebar_state=true; admin_sidebar=false');
        $this->assertStringContainsString('open: false', $html);
    }

    public function test_a_garbage_value_is_ignored(): void
    {
        $html = $this->renderWithCookie('persist', 'sidebar_state=%3Cscript%3E');

        $this->assertStringContainsString('open: true', $html);
    }
}
