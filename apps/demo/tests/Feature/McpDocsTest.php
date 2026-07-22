<?php

namespace Tests\Feature;

use Tests\TestCase;

class McpDocsTest extends TestCase
{
    public function test_mcp_docs_page_renders(): void
    {
        $res = $this->get('/docs/mcp');

        $res->assertOk();
        $res->assertSee('Use BlatUI from your AI editor');
        $res->assertSee('https://blatui.remix-it.com/mcp');
        // Both connection modes + Boost integration are documented.
        $res->assertSee('blatui:mcp');
        $res->assertSee('boost:install');
        $res->assertSee('blatui-development');
    }

    public function test_mcp_docs_is_in_the_sitemap(): void
    {
        $this->get('/sitemap.xml')->assertOk()->assertSee('/docs/mcp');
    }
}
