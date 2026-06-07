<?php

namespace App\Support;

use App\Mcp\HttpServer;

/**
 * Generates the machine-readable discovery documents that make
 * blatui.remix-it.com legible to AI agents: the MCP server card, A2A agent
 * card, Agent Skills index + SKILL.md, the RFC 9727 API catalogue and an
 * OpenAPI description of the registry API.
 *
 * Everything points back to the one real, working surface — the registry at
 * /registry.json and the hosted MCP endpoint at /mcp — so these are honest
 * advertisements, not empty stubs.
 */
class AgentReadiness
{
    public function __construct(
        protected RegistryDistribution $dist,
    ) {}

    protected function base(): string
    {
        return $this->dist->baseUrl();
    }

    protected function brand(): array
    {
        return [
            'name' => config('brand.name', 'BlatUI'),
            'description' => config('brand.description'),
            'url' => $this->base(),
            'github' => config('brand.package', 'https://github.com/anousss007/blatui'),
        ];
    }

    // ---------------------------------------------------------------------
    // /.well-known/mcp/server-card.json  (MCP Server Card, SEP-1649)
    // ---------------------------------------------------------------------

    public function mcpServerCard(): array
    {
        return [
            '$schema' => 'https://modelcontextprotocol.io/schemas/server-card.json',
            'name' => 'blatui',
            'title' => $this->brand()['name'],
            'description' => 'Discover, read and install BlatUI components, blocks and charts (shadcn/ui for Laravel Blade).',
            'version' => 'latest',
            'protocolVersion' => HttpServer::PROTOCOL_VERSION,
            'websiteUrl' => $this->base(),
            'documentationUrl' => $this->base().'/docs',
            'transports' => [
                ['type' => 'streamable-http', 'url' => $this->base().'/mcp'],
            ],
            'capabilities' => ['tools' => (object) []],
            'tools' => array_map(
                fn ($t) => ['name' => $t['name'], 'description' => $t['description']],
                HttpServer::toolDefinitions(),
            ),
            'authentication' => ['type' => 'none'],
        ];
    }

    // ---------------------------------------------------------------------
    // /.well-known/agent-card.json  (A2A Agent Card)
    // ---------------------------------------------------------------------

    public function agentCard(): array
    {
        return [
            'protocolVersion' => '0.3.0',
            'name' => $this->brand()['name'],
            'description' => $this->brand()['description'],
            'url' => $this->base().'/mcp',
            'preferredTransport' => 'JSONRPC',
            'version' => 'latest',
            'provider' => [
                'organization' => $this->brand()['name'],
                'url' => $this->base(),
            ],
            'capabilities' => ['streaming' => false, 'pushNotifications' => false],
            'defaultInputModes' => ['text/plain'],
            'defaultOutputModes' => ['text/plain', 'text/markdown'],
            'skills' => [
                [
                    'id' => 'find-component',
                    'name' => 'Find a UI component',
                    'description' => 'Search BlatUI components, blocks and charts by name or description.',
                    'tags' => ['ui', 'laravel', 'blade', 'components'],
                    'examples' => ['Find a date picker', 'Show me dashboard blocks', 'Is there a command palette?'],
                ],
                [
                    'id' => 'install-component',
                    'name' => 'Install a component',
                    'description' => 'Return the exact `php artisan blatui:add` command and required packages.',
                    'tags' => ['install', 'cli', 'composer', 'npm'],
                    'examples' => ['How do I add the button?', 'Install dialog and tooltip'],
                ],
                [
                    'id' => 'read-source',
                    'name' => 'Read component source',
                    'description' => "Return a component's full Blade source so it can be copied or adapted.",
                    'tags' => ['source', 'blade'],
                    'examples' => ['Show the accordion source', 'How is the sidebar built?'],
                ],
            ],
        ];
    }

    // ---------------------------------------------------------------------
    // /.well-known/agent-skills/index.json  +  SKILL.md
    // ---------------------------------------------------------------------

    public function agentSkillsIndex(): array
    {
        return [
            'version' => '0.2.0',
            'skills' => [
                [
                    'name' => 'blatui',
                    'title' => 'Build UI with BlatUI',
                    'description' => 'How to find, install and use BlatUI components in a Laravel Blade app.',
                    'url' => $this->base().'/.well-known/agent-skills/blatui/SKILL.md',
                    'tags' => ['laravel', 'blade', 'tailwind', 'alpine', 'ui', 'shadcn'],
                ],
            ],
        ];
    }

    public function skillMarkdown(): string
    {
        $base = $this->base();

        return <<<MD
        ---
        name: blatui
        description: Find, install and use BlatUI — shadcn/ui for the Laravel BLAT stack (Blade, Laravel, Alpine.js, Tailwind v4).
        ---

        # Building UI with BlatUI

        BlatUI is an open-source (MIT), copy-paste UI component library for Laravel.
        Components are **copied into the project — the user owns the code**. There is no
        runtime package lock-in. It works with or without Livewire.

        ## Discover

        - Registry index (every component, block, chart): `{$base}/registry.json`
        - Concise index for LLMs: `{$base}/llms.txt`
        - Full reference: `{$base}/llms-full.txt`
        - Hosted MCP endpoint (JSON-RPC over HTTP): `POST {$base}/mcp`
        - A single item with source inlined: `{$base}/r/<name>.json`
          (blocks: `{$base}/r/blocks/<name>.json`, charts: `{$base}/r/charts/<name>.json`)

        ## Install (in a Laravel project)

        ```bash
        composer require blatui/blatui
        php artisan blatui:add <component> [<component> ...]
        ```

        `blatui:add` copies the Blade files into `resources/views/components/ui/` and
        prints any required composer/npm peer packages. Run `php artisan blatui:init`
        once to verify the theme tokens, Alpine and imports are wired up.

        ## Use a component

        Components are Blade components under the `x-ui.` namespace, e.g.:

        ```blade
        <x-ui.button variant="outline">Save</x-ui.button>
        <x-ui.dialog>...</x-ui.dialog>
        ```

        ## Hand-write a component from source

        Fetch `{$base}/r/<name>.json` and write each `files[].content` to its
        `files[].target` path. Resolve `registryDependencies` the same way.

        ## MCP tools (over `{$base}/mcp`)

        - `list_components` — list everything available
        - `search_registry` — search by name/description
        - `get_component` — full Blade source + install command
        - `get_example` — a block or chart's source
        - `install_command` — exact shell commands for one or more components
        MD;
    }

    // ---------------------------------------------------------------------
    // /.well-known/api-catalog  (RFC 9727 linkset, RFC 9264)
    // ---------------------------------------------------------------------

    public function apiCatalog(): array
    {
        $base = $this->base();

        return [
            'linkset' => [[
                'anchor' => $base.'/',
                'service-desc' => [[
                    'href' => $base.'/openapi.json',
                    'type' => 'application/json',
                    'title' => 'BlatUI registry OpenAPI description',
                ]],
                'service-doc' => [[
                    'href' => $base.'/docs',
                    'type' => 'text/html',
                    'title' => 'BlatUI documentation',
                ]],
                'service-meta' => [[
                    'href' => $base.'/.well-known/mcp/server-card.json',
                    'type' => 'application/json',
                    'title' => 'MCP server card',
                ]],
                'item' => [
                    ['href' => $base.'/registry.json', 'type' => 'application/json', 'title' => 'Component registry (shadcn schema)'],
                    ['href' => $base.'/llms.txt', 'type' => 'text/markdown', 'title' => 'LLM index'],
                    ['href' => $base.'/llms-full.txt', 'type' => 'text/markdown', 'title' => 'Full LLM reference'],
                    ['href' => $base.'/mcp', 'type' => 'application/json', 'title' => 'MCP endpoint (Streamable HTTP)'],
                    ['href' => $base.'/sitemap.xml', 'type' => 'application/xml', 'title' => 'Sitemap'],
                ],
            ]],
        ];
    }

    // ---------------------------------------------------------------------
    // /openapi.json  — OpenAPI 3.1 for the registry API
    // ---------------------------------------------------------------------

    public function openApi(): array
    {
        $base = $this->base();
        $nameParam = [
            'name' => 'name',
            'in' => 'path',
            'required' => true,
            'schema' => ['type' => 'string', 'pattern' => '^[a-z0-9-]+$'],
        ];

        return [
            'openapi' => '3.1.0',
            'info' => [
                'title' => 'BlatUI Registry API',
                'version' => '1.0.0',
                'description' => 'Install BlatUI components, blocks and charts from a shadcn-compatible registry.',
                'license' => ['name' => 'MIT'],
            ],
            'servers' => [['url' => $base]],
            'paths' => [
                '/registry.json' => ['get' => [
                    'operationId' => 'getRegistry',
                    'summary' => 'The registry index (every component, block and chart).',
                    'responses' => ['200' => ['description' => 'Registry index', 'content' => ['application/json' => new \stdClass]]],
                ]],
                '/r/{name}.json' => ['get' => [
                    'operationId' => 'getComponent',
                    'summary' => 'A component with its Blade source inlined (registry-item schema).',
                    'parameters' => [$nameParam],
                    'responses' => ['200' => ['description' => 'Registry item'], '404' => ['description' => 'Unknown component']],
                ]],
                '/r/blocks/{name}.json' => ['get' => [
                    'operationId' => 'getBlock',
                    'summary' => 'A full-page block example with source inlined.',
                    'parameters' => [$nameParam],
                    'responses' => ['200' => ['description' => 'Registry item'], '404' => ['description' => 'Unknown block']],
                ]],
                '/r/charts/{name}.json' => ['get' => [
                    'operationId' => 'getChart',
                    'summary' => 'A chart example with source inlined.',
                    'parameters' => [$nameParam],
                    'responses' => ['200' => ['description' => 'Registry item'], '404' => ['description' => 'Unknown chart']],
                ]],
                '/llms.txt' => ['get' => [
                    'operationId' => 'getLlms',
                    'summary' => 'Concise markdown index for LLMs.',
                    'responses' => ['200' => ['description' => 'Markdown', 'content' => ['text/markdown' => new \stdClass]]],
                ]],
                '/mcp' => ['post' => [
                    'operationId' => 'mcp',
                    'summary' => 'Model Context Protocol endpoint (JSON-RPC 2.0, Streamable HTTP).',
                    'responses' => ['200' => ['description' => 'JSON-RPC response']],
                ]],
            ],
        ];
    }

    /**
     * The DNS-AID TXT record the domain owner must publish (we cannot set DNS
     * from the app). Surfaced in docs + tests so it is never forgotten.
     *
     * @return array{host: string, type: string, value: string}
     */
    public function dnsAidRecord(): array
    {
        $host = parse_url($this->base(), PHP_URL_HOST) ?: 'blatui.remix-it.com';

        return [
            'host' => '_blatui._mcp._agents.'.$host,
            'type' => 'TXT',
            'value' => 'v=mcp1; registry='.$this->base().'/registry.json; '
                .'card='.$this->base().'/.well-known/mcp/server-card.json; '
                .'endpoint='.$this->base().'/mcp; public=true; version='.HttpServer::PROTOCOL_VERSION,
        ];
    }
}
