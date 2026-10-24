<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

// A sidebar link marked `current` works out isActive from the page, for the first paint, and
// hands it to x-blat-current to keep up to date in the browser (#54).
class SidebarCurrentTest extends TestCase
{
    private function on(string $path): void
    {
        $this->app->instance('request', Request::create($path));
    }

    private function active(string $tag): bool
    {
        return str_contains(Blade::render($tag), 'data-active="true"');
    }

    public function test_by_default_a_link_is_current_on_its_own_path_and_below_it(): void
    {
        $this->on('/orders/12');

        $this->assertTrue($this->active('<x-ui.sidebar-menu-button href="/orders" current>Orders</x-ui.sidebar-menu-button>'));
        $this->assertTrue($this->active('<x-ui.sidebar-menu-button href="/orders/12/" current>Order</x-ui.sidebar-menu-button>'));
        $this->assertFalse($this->active('<x-ui.sidebar-menu-button href="/order" current>Order</x-ui.sidebar-menu-button>'), 'a prefix that is not a whole segment');
        $this->assertFalse($this->active('<x-ui.sidebar-menu-button href="/orders" current="exact">Orders</x-ui.sidebar-menu-button>'));
        $this->assertFalse($this->active('<x-ui.sidebar-menu-button href="/" current>Home</x-ui.sidebar-menu-button>'), 'the root is always exact');
        $this->assertFalse($this->active('<x-ui.sidebar-menu-button href="https://elsewhere.test/orders" current>Orders</x-ui.sidebar-menu-button>'), 'another host');
    }

    public function test_the_root_and_the_sub_button_match_too(): void
    {
        $this->on('/');
        $this->assertTrue($this->active('<x-ui.sidebar-menu-button href="/" current>Home</x-ui.sidebar-menu-button>'));

        $this->on('/orders/12');
        $html = Blade::render('<x-ui.sidebar-menu-sub-button href="/orders/12" current>Order</x-ui.sidebar-menu-sub-button>');
        $this->assertStringContainsString('data-active="true" aria-current="page"', $html);
        $this->assertStringContainsString('x-blat-current="\'prefix\'"', $html);
    }

    public function test_without_current_the_caller_still_decides(): void
    {
        $this->on('/orders');

        $html = Blade::render('<x-ui.sidebar-menu-button href="/orders">Orders</x-ui.sidebar-menu-button>');
        $this->assertStringNotContainsString('data-active', $html);
        $this->assertStringNotContainsString('x-blat-current', $html);
    }

    public function test_sidebar_content_remembers_its_scroll_only_when_asked(): void
    {
        $this->assertStringNotContainsString('x-blat-scroll-memory', Blade::render('<x-ui.sidebar-content />'));
        $this->assertStringContainsString('x-blat-scroll-memory="\'sidebar_scroll\'"', Blade::render('<x-ui.sidebar-content persist />'));
        $this->assertStringContainsString('x-blat-scroll-memory="\'admin_nav\'"', Blade::render('<x-ui.sidebar-content persist="admin_nav" />'));
    }
}
