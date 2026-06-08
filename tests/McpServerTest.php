<?php

namespace BlatUI\Tests;

use BlatUI\Mcp\RegistryClient;
use BlatUI\Mcp\Server;
use BlatUI\Registry;

class McpServerTest extends TestCase
{
    /** Unreachable base → the client falls back to the bundled stubs (offline, deterministic). */
    protected function server(): Server
    {
        return new Server(new RegistryClient(new Registry, 'http://127.0.0.1:9'), '1.0.0-test');
    }

    private function callTool(Server $server, string $tool, array $args = []): string
    {
        $res = $server->handle([
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'tools/call',
            'params' => ['name' => $tool, 'arguments' => $args],
        ]);

        return $res['result']['content'][0]['text'];
    }

    public function test_initialize_advertises_server_info_and_tools_capability(): void
    {
        $res = $this->server()->handle(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'initialize']);

        $this->assertSame('blatui', $res['result']['serverInfo']['name']);
        $this->assertSame('1.0.0-test', $res['result']['serverInfo']['version']);
        $this->assertArrayHasKey('tools', $res['result']['capabilities']);
        $this->assertNotEmpty($res['result']['protocolVersion']);
    }

    public function test_tools_list_exposes_the_five_tools(): void
    {
        $res = $this->server()->handle(['jsonrpc' => '2.0', 'id' => 2, 'method' => 'tools/list']);

        $names = array_column($res['result']['tools'], 'name');
        sort($names);
        $this->assertSame(
            ['get_component', 'get_example', 'install_command', 'list_components', 'search_registry'],
            $names,
        );
    }

    public function test_notifications_get_no_response(): void
    {
        $res = $this->server()->handle(['jsonrpc' => '2.0', 'method' => 'notifications/initialized']);
        $this->assertNull($res);
    }

    public function test_unknown_method_returns_method_not_found(): void
    {
        $res = $this->server()->handle(['jsonrpc' => '2.0', 'id' => 9, 'method' => 'nope']);
        $this->assertSame(-32601, $res['error']['code']);
    }

    public function test_list_components_offline_fallback_lists_button(): void
    {
        $text = $this->callTool($this->server(), 'list_components');
        $this->assertStringContainsString('button', $text);
        $this->assertStringContainsString('blatui:add', $text);
    }

    public function test_get_component_returns_blade_source_and_install(): void
    {
        $text = $this->callTool($this->server(), 'get_component', ['name' => 'button']);

        $this->assertStringContainsString('php artisan blatui:add button', $text);
        $this->assertStringContainsString('resources/views/components/ui/button.blade.php', $text);
        $this->assertStringContainsString('```blade', $text);
    }

    public function test_get_component_unknown_is_handled_gracefully(): void
    {
        $text = $this->callTool($this->server(), 'get_component', ['name' => 'totally-not-real']);
        $this->assertStringContainsString('not found', $text);
    }

    public function test_install_command_aggregates_packages(): void
    {
        // accordion depends on @alpinejs/collapse in the bundled manifest.
        $text = $this->callTool($this->server(), 'install_command', ['names' => ['accordion']]);

        $this->assertStringContainsString('php artisan blatui:add accordion', $text);
        $this->assertStringContainsString('@alpinejs/collapse', $text);
    }

    public function test_search_offline_matches_by_name(): void
    {
        $text = $this->callTool($this->server(), 'search_registry', ['query' => 'accordion']);
        $this->assertStringContainsString('accordion', $text);
    }

    public function test_initialize_advertises_resources_and_prompts(): void
    {
        $res = $this->server()->handle(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'initialize']);

        $this->assertArrayHasKey('resources', $res['result']['capabilities']);
        $this->assertArrayHasKey('prompts', $res['result']['capabilities']);
    }

    public function test_resources_list_and_read_offline(): void
    {
        $server = $this->server();

        $list = $server->handle(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'resources/list']);
        $this->assertContains('blatui://component/button', array_column($list['result']['resources'], 'uri'));

        $read = $server->handle([
            'jsonrpc' => '2.0', 'id' => 2, 'method' => 'resources/read',
            'params' => ['uri' => 'blatui://component/button'],
        ]);
        $this->assertStringContainsString('@props', $read['result']['contents'][0]['text']);
    }

    public function test_prompts_list_and_get_offline(): void
    {
        $server = $this->server();

        $list = $server->handle(['jsonrpc' => '2.0', 'id' => 1, 'method' => 'prompts/list']);
        $this->assertContains('use-component', array_column($list['result']['prompts'], 'name'));

        $get = $server->handle([
            'jsonrpc' => '2.0', 'id' => 2, 'method' => 'prompts/get',
            'params' => ['name' => 'use-component', 'arguments' => ['name' => 'button']],
        ]);
        $this->assertStringContainsString('blatui:add button', $get['result']['messages'][0]['content']['text']);
    }
}
