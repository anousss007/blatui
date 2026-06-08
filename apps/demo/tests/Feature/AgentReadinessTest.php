<?php

namespace Tests\Feature;

use Tests\TestCase;

class AgentReadinessTest extends TestCase
{
    // --- .well-known discovery documents ---------------------------------

    public function test_mcp_server_card_advertises_the_hosted_endpoint(): void
    {
        $res = $this->get('/.well-known/mcp/server-card.json');

        $res->assertOk();
        $res->assertJsonPath('name', 'blatui');
        $this->assertStringEndsWith('/mcp', $res->json('transports.0.url'));
        $this->assertNotEmpty($res->json('tools'));
    }

    public function test_agent_card_lists_skills(): void
    {
        $res = $this->get('/.well-known/agent-card.json');

        $res->assertOk();
        $res->assertJsonPath('name', 'BlatUI');
        $this->assertNotEmpty($res->json('skills'));
        // A2A discovery requires interfaces with a service URL + transport.
        $this->assertNotEmpty($res->json('supportedInterfaces'));
        $this->assertStringEndsWith('/mcp', $res->json('supportedInterfaces.0.url'));
        $this->assertNotEmpty($res->json('supportedInterfaces.0.transport'));
    }

    public function test_agent_skills_index_and_skill_markdown(): void
    {
        $this->get('/.well-known/agent-skills/index.json')
            ->assertOk()
            ->assertJsonPath('skills.0.name', 'blatui');

        $res = $this->get('/.well-known/agent-skills/blatui/SKILL.md');
        $res->assertOk();
        $res->assertHeader('content-type', 'text/markdown; charset=utf-8');
        $this->assertStringContainsString('blatui:add', $res->getContent());
    }

    public function test_api_catalog_is_a_linkset(): void
    {
        $res = $this->get('/.well-known/api-catalog');

        $res->assertOk();
        $this->assertStringContainsString('application/linkset+json', $res->headers->get('content-type'));
        $this->assertNotEmpty($res->json('linkset'));
        $this->assertStringEndsWith('/openapi.json', $res->json('linkset.0.service-desc.0.href'));
    }

    public function test_openapi_describes_the_registry(): void
    {
        $res = $this->get('/openapi.json');

        $res->assertOk();
        $res->assertJsonPath('openapi', '3.1.0');
        $this->assertArrayHasKey('/registry.json', $res->json('paths'));
        $this->assertArrayHasKey('/mcp', $res->json('paths'));
    }

    // --- Hosted MCP endpoint ---------------------------------------------

    public function test_mcp_initialize_returns_server_info(): void
    {
        $res = $this->postJson('/mcp', ['jsonrpc' => '2.0', 'id' => 1, 'method' => 'initialize']);

        $res->assertOk();
        $res->assertJsonPath('result.serverInfo.name', 'blatui');
        $this->assertNotEmpty($res->json('result.protocolVersion'));
    }

    public function test_mcp_tools_list_exposes_five_tools(): void
    {
        $res = $this->postJson('/mcp', ['jsonrpc' => '2.0', 'id' => 2, 'method' => 'tools/list']);

        $res->assertOk();
        $this->assertCount(5, $res->json('result.tools'));
    }

    public function test_mcp_get_component_returns_blade_source(): void
    {
        $res = $this->postJson('/mcp', [
            'jsonrpc' => '2.0',
            'id' => 3,
            'method' => 'tools/call',
            'params' => ['name' => 'get_component', 'arguments' => ['name' => 'button']],
        ]);

        $res->assertOk();
        $text = $res->json('result.content.0.text');
        $this->assertStringContainsString('```blade', $text);
        $this->assertStringContainsString('blatui:add button', $text);
    }

    public function test_mcp_notification_yields_202(): void
    {
        $this->postJson('/mcp', ['jsonrpc' => '2.0', 'method' => 'notifications/initialized'])
            ->assertStatus(202);
    }

    public function test_mcp_get_is_405(): void
    {
        $this->get('/mcp')->assertStatus(405);
    }

    // --- Content negotiation + discovery headers --------------------------

    public function test_llms_txt_is_markdown(): void
    {
        $this->get('/llms.txt')
            ->assertOk()
            ->assertHeader('content-type', 'text/markdown; charset=utf-8');
    }

    public function test_component_page_has_a_markdown_representation(): void
    {
        // Explicit .md suffix.
        $res = $this->get('/components/button.md');
        $res->assertOk();
        $res->assertHeader('content-type', 'text/markdown; charset=utf-8');
        $this->assertStringContainsString('# Button', $res->getContent());
        $this->assertStringContainsString('```blade', $res->getContent());

        // Accept header negotiation on the homepage.
        $home = $this->get('/', ['Accept' => 'text/markdown']);
        $home->assertOk();
        $this->assertStringContainsString('# BlatUI', $home->getContent());
        $home->assertHeader('content-location');
    }

    public function test_unknown_markdown_page_is_404(): void
    {
        $this->get('/components/not-a-real-component.md')->assertNotFound();
    }

    public function test_html_pages_carry_discovery_link_headers(): void
    {
        $res = $this->get('/');

        $res->assertOk();
        $link = $res->headers->get('link');
        $this->assertStringContainsString('/llms.txt', (string) $link);
        $this->assertStringContainsString('rel="mcp-server"', (string) $link);
        $this->assertStringContainsString('Accept', (string) $res->headers->get('vary'));
    }
}
