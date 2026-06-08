<?php

namespace App\Mcp;

use App\Support\RegistryDistribution;

/**
 * Stateless HTTP (Streamable-HTTP transport) Model Context Protocol server for
 * blatui.remix-it.com. Each POST to /mcp is an independent JSON-RPC request.
 *
 * Backed directly by the on-disk registry (RegistryDistribution), so the tools
 * an AI editor sees over the network are the exact components, blocks and
 * charts the site documents — always current, no build step.
 */
class HttpServer
{
    public const PROTOCOL_VERSION = '2025-06-18';

    public function __construct(
        protected RegistryDistribution $dist,
    ) {}

    /** The tool catalogue, shared with the MCP server card + agent card. */
    public static function toolDefinitions(): array
    {
        return [
            [
                'name' => 'list_components',
                'description' => 'List every BlatUI component with its title and one-line description. Optionally filter by category.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => ['category' => ['type' => 'string']],
                ],
            ],
            [
                'name' => 'search_registry',
                'description' => 'Search BlatUI components, blocks and charts by name, title or description.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'query' => ['type' => 'string'],
                        'type' => ['type' => 'string', 'enum' => ['component', 'block', 'chart']],
                    ],
                    'required' => ['query'],
                ],
            ],
            [
                'name' => 'get_component',
                'description' => "Get a component's full Blade source, dependencies, required packages and install command.",
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => ['name' => ['type' => 'string']],
                    'required' => ['name'],
                ],
            ],
            [
                'name' => 'get_example',
                'description' => 'Get the full Blade source of a block or chart, plus the components and packages it needs.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'kind' => ['type' => 'string', 'enum' => ['block', 'chart']],
                        'name' => ['type' => 'string'],
                    ],
                    'required' => ['kind', 'name'],
                ],
            ],
            [
                'name' => 'install_command',
                'description' => 'Build the exact `php artisan blatui:add` command plus required composer/npm packages for one or more components.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => ['names' => ['type' => 'array', 'items' => ['type' => 'string']]],
                    'required' => ['names'],
                ],
            ],
        ];
    }

    /**
     * Handle one JSON-RPC message; null for notifications.
     *
     * @param  array<string, mixed>  $message
     */
    public function handle(array $message): ?array
    {
        $id = $message['id'] ?? null;
        $method = $message['method'] ?? null;

        if (! array_key_exists('id', $message)) {
            return null; // notification
        }

        try {
            $result = match ($method) {
                'initialize' => [
                    'protocolVersion' => self::PROTOCOL_VERSION,
                    'capabilities' => [
                        'tools' => (object) [],
                        'resources' => (object) [],
                        'prompts' => (object) [],
                    ],
                    'serverInfo' => ['name' => 'blatui', 'version' => 'latest'],
                    'instructions' => 'BlatUI is shadcn/ui for Laravel Blade. Search components/blocks/charts, '
                        .'read their Blade source, and get the exact `php artisan blatui:add` install command. '
                        .'Components are copied into the project — the user owns the code.',
                ],
                'tools/list' => ['tools' => self::toolDefinitions()],
                'tools/call' => $this->callTool($message['params'] ?? []),
                'resources/list' => $this->resourcesList(),
                'resources/templates/list' => $this->resourceTemplates(),
                'resources/read' => $this->resourceRead($message['params'] ?? []),
                'prompts/list' => $this->promptsList(),
                'prompts/get' => $this->promptsGet($message['params'] ?? []),
                'ping' => (object) [],
                default => throw new \RuntimeException("Method not found: {$method}", -32601),
            };

            return ['jsonrpc' => '2.0', 'id' => $id, 'result' => $result];
        } catch (\Throwable $e) {
            $code = $e->getCode() ?: -32603;

            return ['jsonrpc' => '2.0', 'id' => $id, 'error' => ['code' => $code, 'message' => $e->getMessage()]];
        }
    }

    /** @param array<string, mixed> $params */
    protected function callTool(array $params): array
    {
        $name = $params['name'] ?? '';
        $args = $params['arguments'] ?? [];

        $text = match ($name) {
            'list_components' => $this->listComponents($args),
            'search_registry' => $this->search($args),
            'get_component' => $this->getComponent($args),
            'get_example' => $this->getExample($args),
            'install_command' => $this->installCommand($args),
            default => throw new \RuntimeException("Unknown tool: {$name}", -32602),
        };

        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    // ---------------------------------------------------------------------
    // Tools
    // ---------------------------------------------------------------------

    protected function items(): array
    {
        return $this->dist->index()['items'];
    }

    protected function listComponents(array $args): string
    {
        $category = isset($args['category']) ? mb_strtolower((string) $args['category']) : null;

        $lines = [];
        foreach ($this->items() as $i) {
            if (($i['type'] ?? '') !== 'registry:ui') {
                continue;
            }
            if ($category !== null && ! str_contains(mb_strtolower(implode(' ', $i['categories'] ?? [])), $category)) {
                continue;
            }
            $lines[] = '- '.$i['name'].(! empty($i['description']) ? ' — '.$i['description'] : '');
        }

        return $lines
            ? count($lines)." components:\n".implode("\n", $lines)."\n\nInstall: php artisan blatui:add <name>"
            : 'No components found.';
    }

    protected function search(array $args): string
    {
        $query = mb_strtolower(trim((string) ($args['query'] ?? '')));
        $kind = $args['type'] ?? null;

        $matches = array_filter($this->items(), function ($i) use ($query, $kind) {
            if ($kind === 'component' && ($i['type'] ?? '') !== 'registry:ui') {
                return false;
            }
            if ($kind === 'block' && (($i['type'] ?? '') !== 'registry:block' || $this->isChart($i))) {
                return false;
            }
            if ($kind === 'chart' && ! $this->isChart($i)) {
                return false;
            }
            $hay = mb_strtolower($i['name'].' '.($i['title'] ?? '').' '.($i['description'] ?? '').' '.implode(' ', $i['categories'] ?? []));

            return $query === '' || str_contains($hay, $query);
        });

        if (! $matches) {
            return 'No matches for "'.($args['query'] ?? '').'".';
        }

        $lines = [];
        foreach (array_slice(array_values($matches), 0, 40) as $i) {
            $label = ($i['type'] ?? '') === 'registry:ui' ? 'component' : ($this->isChart($i) ? 'chart' : 'block');
            $lines[] = '- ['.$label.'] '.$i['name'].(! empty($i['description']) ? ' — '.$i['description'] : '');
        }

        return count($matches).' match(es):'."\n".implode("\n", $lines);
    }

    protected function getComponent(array $args): string
    {
        $item = $this->dist->componentItem((string) ($args['name'] ?? ''));

        return $item ? $this->render($item) : 'Component not found. Try list_components or search_registry.';
    }

    protected function getExample(array $args): string
    {
        $kind = (string) ($args['kind'] ?? 'block');
        $name = (string) ($args['name'] ?? '');
        $item = $kind === 'chart' ? $this->dist->chartItem($name) : $this->dist->blockItem($name);

        return $item ? $this->render($item) : ucfirst($kind).' "'.$name.'" not found.';
    }

    protected function installCommand(array $args): string
    {
        $names = array_values(array_filter((array) ($args['names'] ?? []), 'is_string'));
        if (! $names) {
            return 'Provide one or more component names.';
        }

        $composer = $npm = [];
        foreach ($names as $name) {
            if ($item = $this->dist->componentItem($name)) {
                $composer = array_merge($composer, $item['meta']['composer'] ?? []);
                $npm = array_merge($npm, $item['meta']['npm'] ?? []);
            }
        }

        $out = ['php artisan blatui:add '.implode(' ', $names)];
        if ($composer = array_values(array_unique($composer))) {
            $out[] = 'composer require '.implode(' ', $composer);
        }
        if ($npm = array_values(array_unique($npm))) {
            $out[] = 'npm install -D '.implode(' ', $npm);
        }

        return implode("\n", $out);
    }

    // ---------------------------------------------------------------------
    // Resources — components/blocks/charts as readable MCP resources
    // ---------------------------------------------------------------------

    protected function resourcesList(): array
    {
        $resources = [];
        foreach ($this->items() as $i) {
            if (($i['type'] ?? '') !== 'registry:ui') {
                continue;
            }
            $resources[] = array_filter([
                'uri' => 'blatui://component/'.$i['name'],
                'name' => $i['title'] ?? $i['name'],
                'description' => $i['description'] ?? null,
                'mimeType' => 'text/plain',
            ], fn ($v) => $v !== null);
        }

        return ['resources' => $resources];
    }

    protected function resourceTemplates(): array
    {
        return ['resourceTemplates' => [
            ['uriTemplate' => 'blatui://component/{name}', 'name' => 'BlatUI component', 'description' => 'Blade source of a component family', 'mimeType' => 'text/plain'],
            ['uriTemplate' => 'blatui://block/{name}', 'name' => 'BlatUI block', 'description' => 'Full-page block example', 'mimeType' => 'text/plain'],
            ['uriTemplate' => 'blatui://chart/{name}', 'name' => 'BlatUI chart', 'description' => 'Chart example', 'mimeType' => 'text/plain'],
        ]];
    }

    protected function resourceRead(array $params): array
    {
        $uri = (string) ($params['uri'] ?? '');
        if (! preg_match('#^blatui://(component|block|chart)/([a-z0-9-]+)$#', $uri, $m)) {
            throw new \RuntimeException("Unknown resource: {$uri}", -32602);
        }

        $item = match ($m[1]) {
            'block' => $this->dist->blockItem($m[2]),
            'chart' => $this->dist->chartItem($m[2]),
            default => $this->dist->componentItem($m[2]),
        };
        if ($item === null) {
            throw new \RuntimeException("Resource not found: {$uri}", -32602);
        }

        $text = '';
        foreach ($item['files'] ?? [] as $f) {
            $text .= ($f['target'] ?? '')."\n".($f['content'] ?? '')."\n\n";
        }

        return ['contents' => [['uri' => $uri, 'mimeType' => 'text/plain', 'text' => rtrim($text)]]];
    }

    // ---------------------------------------------------------------------
    // Prompts — reusable agent workflows
    // ---------------------------------------------------------------------

    protected function promptsList(): array
    {
        return ['prompts' => [
            [
                'name' => 'use-component',
                'description' => 'Insert a BlatUI component with its source and install command.',
                'arguments' => [['name' => 'name', 'description' => 'Component slug (e.g. button, dialog).', 'required' => true]],
            ],
            [
                'name' => 'scaffold-page',
                'description' => 'Scaffold a full page from BlatUI blocks (dashboard, login, signup, marketing, pricing).',
                'arguments' => [['name' => 'kind', 'description' => 'dashboard | login | signup | marketing | pricing', 'required' => true]],
            ],
        ]];
    }

    protected function promptsGet(array $params): array
    {
        $name = (string) ($params['name'] ?? '');
        $args = $params['arguments'] ?? [];
        $base = $this->dist->baseUrl();

        if ($name === 'use-component') {
            $slug = (string) ($args['name'] ?? '');
            $item = $this->dist->componentItem($slug);
            $body = $item ? $this->render($item) : "Component '{$slug}' not found — use the list_components tool to discover names.";

            return [
                'description' => "Use the BlatUI {$slug} component",
                'messages' => [['role' => 'user', 'content' => ['type' => 'text',
                    'text' => "Add the BlatUI \"{$slug}\" component to my Laravel Blade app and use it. Source + install:\n\n".$body]]],
            ];
        }

        if ($name === 'scaffold-page') {
            $kind = (string) ($args['kind'] ?? 'dashboard');

            return [
                'description' => "Scaffold a {$kind} page with BlatUI",
                'messages' => [['role' => 'user', 'content' => ['type' => 'text',
                    'text' => "Build a {$kind} page for my Laravel app using BlatUI blocks. Browse {$base}/blocks for {$kind}-* examples, "
                        ."fetch the chosen block from {$base}/r/blocks/<name>.json (write each files[].content to files[].target), "
                        .'run `php artisan blatui:add` for its registryDependencies, then adapt the content to my app.']]],
            ];
        }

        throw new \RuntimeException("Unknown prompt: {$name}", -32602);
    }

    // ---------------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------------

    protected function render(array $item): string
    {
        $out = ['# '.($item['title'] ?? $item['name'])];
        if (! empty($item['description'])) {
            $out[] = $item['description'];
        }

        // Install command: a component installs itself; a block/chart installs
        // the components it depends on.
        $install = ($item['type'] ?? '') === 'registry:ui'
            ? 'php artisan blatui:add '.$item['name']
            : (($deps = $item['registryDependencies'] ?? []) ? 'php artisan blatui:add '.implode(' ', $deps) : null);
        if ($install) {
            $out[] = 'Install: '.$install;
        }

        if ($deps = $item['registryDependencies'] ?? []) {
            $out[] = 'Depends on: '.implode(', ', $deps);
        }
        if ($composer = $item['meta']['composer'] ?? []) {
            $out[] = 'composer require '.implode(' ', $composer);
        }
        if ($npm = $item['meta']['npm'] ?? []) {
            $out[] = 'npm install -D '.implode(' ', $npm);
        }
        foreach ($item['files'] ?? [] as $f) {
            $out[] = "\n## ".($f['target'] ?? '')."\n```blade\n".rtrim((string) ($f['content'] ?? ''))."\n```";
        }

        return implode("\n", $out)."\n";
    }

    protected function isChart(array $item): bool
    {
        return in_array('chart', array_map('mb_strtolower', $item['categories'] ?? []), true)
            || str_starts_with((string) ($item['name'] ?? ''), 'chart-');
    }
}
