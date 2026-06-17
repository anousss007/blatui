<x-layouts.app title="MCP server" description="Use BlatUI from your AI editor. Connect the hosted or local MCP server so Claude Code, Cursor, VS Code and others can search, read and install BlatUI components — plus first-class Laravel Boost integration.">
    <x-site.header active="docs" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[760px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-3xl px-6 py-16 text-center lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-server class="size-3.5" /> Model Context Protocol
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Use BlatUI from your AI editor</h1>
            <p class="text-muted-foreground mt-4 text-lg text-balance">
                Connect the BlatUI MCP server and your agent can search, read and install components,
                blocks and charts — straight into your Laravel project. Works with Claude Code, Cursor,
                VS Code, Windsurf, Codex and any MCP client.
            </p>
        </div>
    </section>

    <div class="mx-auto max-w-3xl px-6 py-14 lg:px-8">
        {{-- Two ways to connect --}}
        <h2 id="connect" class="mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Two ways to connect</h2>
        <p class="text-muted-foreground mb-8">Use the hosted server for zero-install discovery, or the local one to read components straight from your project.</p>

        <div class="space-y-10">
            {{-- Hosted --}}
            <div>
                <h3 class="mb-1 flex items-center gap-2 text-lg font-semibold">
                    <span class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-full text-xs">A</span>
                    Hosted — no install
                </h3>
                <p class="text-muted-foreground mb-3 text-sm">One public, stateless endpoint. Point any MCP-capable editor at it — the URL never changes:</p>
                <x-code-block label="MCP endpoint" icon="link">https://blatui.remix-it.com/mcp</x-code-block>

                <p class="text-muted-foreground mt-6 mb-3 text-sm font-medium">Pick your editor — same server, slightly different config file:</p>

                <div class="space-y-6">
                    {{-- Claude Code --}}
                    <div>
                        <h4 class="mb-2 flex items-center gap-2 text-sm font-semibold">
                            <x-lucide-sparkles class="text-primary size-4" /> Claude Code
                            <span class="text-muted-foreground font-normal">· one command</span>
                        </h4>
                        <x-code-block label="Terminal" icon="terminal">claude mcp add -t http blatui https://blatui.remix-it.com/mcp</x-code-block>
                    </div>

                    {{-- GitHub Copilot / VS Code --}}
                    <div>
                        <h4 class="mb-2 flex items-center gap-2 text-sm font-semibold">
                            <x-lucide-github class="text-primary size-4" /> GitHub Copilot — VS Code
                            <span class="text-muted-foreground font-normal">· .vscode/mcp.json</span>
                        </h4>
                        <x-code-block label=".vscode/mcp.json" icon="braces">{
    "servers": {
        "blatui": { "type": "http", "url": "https://blatui.remix-it.com/mcp" }
    }
}</x-code-block>
                        <p class="text-muted-foreground mt-2 text-xs">VS Code 1.101+. Note the key is <code class="text-foreground">servers</code> (not <code class="text-foreground">mcpServers</code>). You can also run the <code class="text-foreground">MCP: Add Server</code> command and pick <em>HTTP</em>.</p>
                    </div>

                    {{-- Cursor --}}
                    <div>
                        <h4 class="mb-2 flex items-center gap-2 text-sm font-semibold">
                            <x-lucide-mouse-pointer-2 class="text-primary size-4" /> Cursor
                            <span class="text-muted-foreground font-normal">· .cursor/mcp.json</span>
                        </h4>
                        <x-code-block label=".cursor/mcp.json" icon="braces">{
    "mcpServers": {
        "blatui": { "url": "https://blatui.remix-it.com/mcp" }
    }
}</x-code-block>
                    </div>

                    {{-- OpenAI Codex --}}
                    <div>
                        <h4 class="mb-2 flex items-center gap-2 text-sm font-semibold">
                            <x-lucide-bot class="text-primary size-4" /> OpenAI Codex
                            <span class="text-muted-foreground font-normal">· ~/.codex/config.toml</span>
                        </h4>
                        <x-code-block label="~/.codex/config.toml" icon="braces">[mcp_servers.blatui]
url = "https://blatui.remix-it.com/mcp"</x-code-block>
                        <p class="text-muted-foreground mt-2 text-xs">Or run <code class="text-foreground">codex mcp add</code>. TOML, not JSON.</p>
                    </div>

                    {{-- Windsurf --}}
                    <div>
                        <h4 class="mb-2 flex items-center gap-2 text-sm font-semibold">
                            <x-lucide-wind class="text-primary size-4" /> Windsurf
                            <span class="text-muted-foreground font-normal">· ~/.codeium/windsurf/mcp_config.json</span>
                        </h4>
                        <x-code-block label="~/.codeium/windsurf/mcp_config.json" icon="braces">{
    "mcpServers": {
        "blatui": { "serverUrl": "https://blatui.remix-it.com/mcp" }
    }
}</x-code-block>
                        <p class="text-muted-foreground mt-2 text-xs">Windsurf uses <code class="text-foreground">serverUrl</code> for remote servers.</p>
                    </div>

                    {{-- Any other client --}}
                    <div>
                        <h4 class="mb-2 flex items-center gap-2 text-sm font-semibold">
                            <x-lucide-plug class="text-primary size-4" /> Any other MCP client
                            <span class="text-muted-foreground font-normal">· Zed, Gemini CLI, JetBrains, n8n…</span>
                        </h4>
                        <x-code-block label="MCP standard config" icon="braces">{
    "mcpServers": {
        "blatui": { "type": "streamable-http", "url": "https://blatui.remix-it.com/mcp" }
    }
}</x-code-block>
                        <p class="text-muted-foreground mt-2 text-xs">Streamable HTTP transport. Some clients label the type <code class="text-foreground">http</code> — both point at the same endpoint.</p>
                    </div>
                </div>
            </div>

            {{-- Local --}}
            <div>
                <h3 class="mb-1 flex items-center gap-2 text-lg font-semibold">
                    <span class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-full text-xs">B</span>
                    Local — reads your project
                </h3>
                <p class="text-muted-foreground mb-3 text-sm">Prefer to serve component source straight from your own copy (offline-friendly)? Install the package, then point any editor at the stdio server. Install once:</p>
                <x-code-block label="Terminal" icon="terminal">composer require anousss007/blatui</x-code-block>
                <p class="text-muted-foreground mt-3 mb-3 text-sm">Register <code class="text-foreground">php artisan blatui:mcp</code> with your editor. In Claude Code:</p>
                <x-code-block label="Terminal" icon="terminal">claude mcp add -s local -t stdio blatui php artisan blatui:mcp</x-code-block>
                <p class="text-muted-foreground mt-3 mb-3 text-sm">Every other editor — same config file as above, but a <code class="text-foreground">command</code>/<code class="text-foreground">args</code> pair instead of a URL:</p>
                <x-code-block label=".mcp.json / .cursor/mcp.json" icon="braces">{
    "mcpServers": {
        "blatui": { "command": "php", "args": ["artisan", "blatui:mcp"] }
    }
}</x-code-block>
                <p class="text-muted-foreground mt-2 text-xs">VS Code nests it under <code class="text-foreground">servers</code>; Codex uses <code class="text-foreground">[mcp_servers.blatui]</code> with <code class="text-foreground">command</code> + <code class="text-foreground">args</code> — same idea, local stdio.</p>
            </div>
        </div>

        {{-- Capabilities --}}
        <h2 id="capabilities" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">What your agent can do</h2>
        <p class="text-muted-foreground mb-6">The server exposes tools, resources and prompts.</p>

        <div class="grid gap-4 sm:grid-cols-3">
            <div class="bg-card rounded-xl border p-5">
                <h3 class="mb-2 flex items-center gap-2 text-sm font-semibold"><x-lucide-wrench class="text-primary size-4" /> Tools</h3>
                <ul class="text-muted-foreground space-y-1 text-sm">
                    <li><code class="text-foreground">search_registry</code></li>
                    <li><code class="text-foreground">list_components</code></li>
                    <li><code class="text-foreground">get_component</code></li>
                    <li><code class="text-foreground">get_example</code></li>
                    <li><code class="text-foreground">install_command</code></li>
                </ul>
            </div>
            <div class="bg-card rounded-xl border p-5">
                <h3 class="mb-2 flex items-center gap-2 text-sm font-semibold"><x-lucide-file-code class="text-primary size-4" /> Resources</h3>
                <p class="text-muted-foreground text-sm">Read any item's Blade source by URI:</p>
                <ul class="text-muted-foreground mt-2 space-y-1 text-sm">
                    <li><code class="text-foreground">blatui://component/{name}</code></li>
                    <li><code class="text-foreground">blatui://block/{name}</code></li>
                    <li><code class="text-foreground">blatui://chart/{name}</code></li>
                </ul>
            </div>
            <div class="bg-card rounded-xl border p-5">
                <h3 class="mb-2 flex items-center gap-2 text-sm font-semibold"><x-lucide-sparkles class="text-primary size-4" /> Prompts</h3>
                <ul class="text-muted-foreground space-y-1 text-sm">
                    <li><code class="text-foreground">use-component</code></li>
                    <li><code class="text-foreground">scaffold-page</code></li>
                </ul>
            </div>
        </div>

        {{-- Laravel Boost --}}
        <h2 id="boost" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Laravel Boost integration</h2>
        <p class="text-muted-foreground mb-4">
            BlatUI ships first-class <a href="https://laravel.com/docs/13.x/boost" class="text-foreground underline underline-offset-4" target="_blank" rel="noopener">Laravel Boost</a>
            guidelines and an agent skill. If your project uses Boost, your AI already knows how to use BlatUI —
            no extra setup. Install Boost and select the features:
        </p>
        <x-code-block label="Terminal" icon="terminal">composer require laravel/boost --dev
php artisan boost:install</x-code-block>
        <p class="text-muted-foreground mt-4 text-sm">
            Because <code class="text-foreground">anousss007/blatui</code> ships
            <code class="text-foreground">resources/boost/guidelines/core.blade.php</code> and a
            <code class="text-foreground">blatui-development</code> skill, Boost loads BlatUI's conventions
            (the <code class="text-foreground">x-ui.</code> namespace, <code class="text-foreground">blatui:add</code>,
            theming) into your agent's context automatically. The BlatUI MCP server complements Boost — Boost knows
            your app; BlatUI knows every component.
        </p>

        {{-- No editor --}}
        <h2 id="no-editor" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">No MCP client? Just fetch</h2>
        <p class="text-muted-foreground mb-4">Everything the MCP server returns is also plain HTTP — usable from any script or agent:</p>
        <x-code-block label="Terminal" icon="terminal">curl https://blatui.remix-it.com/registry.json          # every component, block, chart
curl https://blatui.remix-it.com/r/button.json          # one item, Blade source inlined
curl https://blatui.remix-it.com/llms.txt               # concise index for LLMs</x-code-block>
    </div>
</x-layouts.app>
