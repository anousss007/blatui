<?php

namespace BlatUI\Mcp;

/**
 * A minimal, dependency-free Model Context Protocol server for BlatUI.
 *
 * Speaks JSON-RPC 2.0 and exposes tools that let an AI editor discover,
 * read and install BlatUI components, blocks and charts directly from the
 * registry. The transport (newline-delimited JSON over stdio) lives in
 * McpCommand; this class is pure request → response so it is unit-testable.
 */
class Server
{
    public const PROTOCOL_VERSION = '2025-06-18';

    public function __construct(
        protected RegistryClient $client,
        protected string $version = 'dev',
    ) {}

    /**
     * Handle one JSON-RPC message. Returns the response array, or null for
     * notifications (which must not be answered).
     *
     * @param  array<string, mixed>  $message
     */
    public function handle(array $message): ?array
    {
        $method = $message['method'] ?? null;
        $id = $message['id'] ?? null;
        $isNotification = ! array_key_exists('id', $message);

        // Notifications (initialized, cancelled, …) get no reply.
        if ($isNotification) {
            return null;
        }

        try {
            $result = match ($method) {
                'initialize' => $this->initialize(),
                'tools/list' => $this->toolsList(),
                'tools/call' => $this->toolsCall($message['params'] ?? []),
                'ping' => (object) [],
                default => throw new McpError(-32601, "Method not found: {$method}"),
            };

            return $this->result($id, $result);
        } catch (McpError $e) {
            return $this->error($id, $e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            return $this->error($id, -32603, 'Internal error: '.$e->getMessage());
        }
    }

    // ---------------------------------------------------------------------
    // Protocol methods
    // ---------------------------------------------------------------------

    protected function initialize(): array
    {
        return [
            'protocolVersion' => self::PROTOCOL_VERSION,
            'capabilities' => ['tools' => (object) []],
            'serverInfo' => ['name' => 'blatui', 'version' => $this->version],
            'instructions' => 'BlatUI is shadcn/ui for Laravel Blade (Blade, Alpine.js, Tailwind v4). '
                .'Use search_registry to find components/blocks/charts, get_component to read a '
                .'component\'s Blade source, and install_command to get the exact `php artisan '
                .'blatui:add` invocation. Components are copied into the project — the user owns the code.',
        ];
    }

    protected function toolsList(): array
    {
        return ['tools' => [
            [
                'name' => 'list_components',
                'description' => 'List every BlatUI component (name, title, one-line description). Optionally filter by category (e.g. "Forms & Input", "Overlays").',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'category' => ['type' => 'string', 'description' => 'Optional category label to filter by.'],
                    ],
                ],
            ],
            [
                'name' => 'search_registry',
                'description' => 'Search BlatUI components, blocks and charts by name, title or description. Returns matches with their install commands.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'query' => ['type' => 'string', 'description' => 'Free-text query, e.g. "date picker", "dashboard", "bar chart".'],
                        'type' => ['type' => 'string', 'enum' => ['component', 'block', 'chart'], 'description' => 'Optional: restrict to one kind.'],
                    ],
                    'required' => ['query'],
                ],
            ],
            [
                'name' => 'get_component',
                'description' => 'Get a BlatUI component\'s full Blade source (every file), its dependencies, the required composer/npm packages, and the exact install command. Use this to read or hand-write a component.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'name' => ['type' => 'string', 'description' => 'Component family slug, e.g. "button", "alert-dialog", "date-picker".'],
                    ],
                    'required' => ['name'],
                ],
            ],
            [
                'name' => 'get_example',
                'description' => 'Get the full Blade source of a block (full-page example) or chart, plus the components and packages it needs.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'kind' => ['type' => 'string', 'enum' => ['block', 'chart'], 'description' => 'Which kind of example.'],
                        'name' => ['type' => 'string', 'description' => 'Example slug, e.g. "dashboard-01", "chart-area-default".'],
                    ],
                    'required' => ['kind', 'name'],
                ],
            ],
            [
                'name' => 'install_command',
                'description' => 'Build the exact shell commands to add one or more BlatUI components to a Laravel project: the `php artisan blatui:add` line plus any required composer/npm packages.',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'names' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Component slugs to install.'],
                    ],
                    'required' => ['names'],
                ],
            ],
        ]];
    }

    /** @param array<string, mixed> $params */
    protected function toolsCall(array $params): array
    {
        $name = $params['name'] ?? '';
        $args = $params['arguments'] ?? [];

        $text = match ($name) {
            'list_components' => $this->toolListComponents($args),
            'search_registry' => $this->toolSearch($args),
            'get_component' => $this->toolGetComponent($args),
            'get_example' => $this->toolGetExample($args),
            'install_command' => $this->toolInstallCommand($args),
            default => throw new McpError(-32602, "Unknown tool: {$name}"),
        };

        return ['content' => [['type' => 'text', 'text' => $text]]];
    }

    // ---------------------------------------------------------------------
    // Tool implementations (return plain text for the model)
    // ---------------------------------------------------------------------

    protected function toolListComponents(array $args): string
    {
        $category = isset($args['category']) ? mb_strtolower((string) $args['category']) : null;
        $components = $this->client->itemsOfType('registry:ui');

        $lines = [];
        foreach ($components as $c) {
            if ($category !== null) {
                $cats = array_map('mb_strtolower', $c['categories'] ?? []);
                if (! in_array($category, $cats, true) && ! str_contains(implode(' ', $cats), $category)) {
                    continue;
                }
            }
            $desc = $c['description'] ?? '';
            $lines[] = '- '.($c['name']).($desc ? ' — '.$desc : '');
        }

        if (! $lines) {
            return 'No components found'.($category ? ' for category "'.$args['category'].'".' : '.');
        }

        return count($lines)." components:\n".implode("\n", $lines)
            ."\n\nInstall any with: php artisan blatui:add <name>";
    }

    protected function toolSearch(array $args): string
    {
        $query = (string) ($args['query'] ?? '');
        $kind = $args['type'] ?? null;

        $type = match ($kind) {
            'component' => 'registry:ui',
            'block', 'chart' => 'registry:block',
            default => null,
        };

        $results = $this->client->search($query, $type);

        // Distinguish blocks from charts (both are registry:block).
        if ($kind === 'chart') {
            $results = array_values(array_filter($results, fn ($i) => $this->isChart($i)));
        } elseif ($kind === 'block') {
            $results = array_values(array_filter($results, fn ($i) => ! $this->isChart($i)));
        }

        if (! $results) {
            return 'No matches for "'.$query.'".';
        }

        $lines = [];
        foreach (array_slice($results, 0, 40) as $i) {
            $label = $this->kindLabel($i);
            $desc = $i['description'] ?? '';
            $lines[] = '- ['.$label.'] '.$i['name'].($desc ? ' — '.$desc : '');
        }

        $more = count($results) > 40 ? "\n… and ".(count($results) - 40).' more.' : '';

        return count($results).' match(es) for "'.$query.'":'."\n".implode("\n", $lines).$more
            ."\n\nRead a component with get_component, a block/chart with get_example.";
    }

    protected function toolGetComponent(array $args): string
    {
        $name = (string) ($args['name'] ?? '');
        $item = $this->client->component($name);

        if ($item === null) {
            return 'Component "'.$name.'" not found. Use list_components or search_registry to discover names.';
        }

        return $this->renderItem($item, 'php artisan blatui:add '.$name);
    }

    protected function toolGetExample(array $args): string
    {
        $kind = (string) ($args['kind'] ?? 'block');
        $name = (string) ($args['name'] ?? '');
        $item = $this->client->example($kind, $name);

        if ($item === null) {
            return ucfirst($kind).' "'.$name.'" not found, or the registry is unreachable offline. '
                .'Browse at '.$this->client->base().'/'.($kind === 'chart' ? 'charts' : 'blocks').'.';
        }

        $deps = $item['registryDependencies'] ?? [];
        $install = $deps ? 'php artisan blatui:add '.implode(' ', $deps) : null;

        return $this->renderItem($item, $install);
    }

    protected function toolInstallCommand(array $args): string
    {
        $names = array_values(array_filter((array) ($args['names'] ?? []), 'is_string'));
        if (! $names) {
            return 'Provide one or more component names.';
        }

        $composer = [];
        $npm = [];
        $unknown = [];
        foreach ($names as $name) {
            $item = $this->client->component($name);
            if ($item === null) {
                $unknown[] = $name;

                continue;
            }
            $composer = array_merge($composer, $item['composer'] ?? []);
            $npm = array_merge($npm, $item['npm'] ?? []);
        }

        $lines = [];
        $lines[] = '# Add the components (you own the copied code):';
        $lines[] = 'php artisan blatui:add '.implode(' ', $names);

        $composer = array_values(array_unique($composer));
        $npm = array_values(array_unique($npm));
        if ($composer) {
            $lines[] = '';
            $lines[] = '# Required composer packages:';
            $lines[] = 'composer require '.implode(' ', $composer);
        }
        if ($npm) {
            $lines[] = '';
            $lines[] = '# Required npm packages:';
            $lines[] = 'npm install -D '.implode(' ', $npm);
        }
        if ($unknown) {
            $lines[] = '';
            $lines[] = '# Unknown (skipped): '.implode(', ', $unknown);
        }

        return implode("\n", $lines);
    }

    // ---------------------------------------------------------------------
    // Rendering + helpers
    // ---------------------------------------------------------------------

    protected function renderItem(array $item, ?string $install): string
    {
        $out = [];
        $out[] = '# '.($item['title'] ?? $item['name']);
        if (! empty($item['description'])) {
            $out[] = $item['description'];
        }
        $out[] = '';
        if ($install) {
            $out[] = 'Install: '.$install;
        }
        if ($deps = $item['registryDependencies'] ?? []) {
            $out[] = 'Depends on components: '.implode(', ', $deps);
        }
        if ($composer = $item['composer'] ?? []) {
            $out[] = 'composer require '.implode(' ', $composer);
        }
        if ($npm = $item['npm'] ?? []) {
            $out[] = 'npm install -D '.implode(' ', $npm);
        }
        $out[] = '';

        foreach ($item['files'] ?? [] as $file) {
            $out[] = '## '.($file['target'] ?? 'file');
            $out[] = '```blade';
            $out[] = rtrim((string) ($file['content'] ?? ''));
            $out[] = '```';
            $out[] = '';
        }

        return rtrim(implode("\n", $out))."\n";
    }

    protected function isChart(array $item): bool
    {
        $cats = array_map('mb_strtolower', $item['categories'] ?? []);

        return in_array('chart', $cats, true) || str_starts_with((string) ($item['name'] ?? ''), 'chart-');
    }

    protected function kindLabel(array $item): string
    {
        if (($item['type'] ?? '') === 'registry:ui') {
            return 'component';
        }

        return $this->isChart($item) ? 'chart' : 'block';
    }

    // ---------------------------------------------------------------------
    // JSON-RPC envelopes
    // ---------------------------------------------------------------------

    protected function result(mixed $id, mixed $result): array
    {
        return ['jsonrpc' => '2.0', 'id' => $id, 'result' => $result];
    }

    protected function error(mixed $id, int $code, string $message): array
    {
        return ['jsonrpc' => '2.0', 'id' => $id, 'error' => ['code' => $code, 'message' => $message]];
    }
}
