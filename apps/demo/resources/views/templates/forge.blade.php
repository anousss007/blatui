@php
    $nav = ['Docs' => '#docs', 'Pricing' => '#pricing', 'Changelog' => '#changelog'];

    $logos = ['Vercel', 'Linear', 'Stripe', 'Resend', 'PlanetScale', 'Clerk', 'Neon', 'Turso', 'Railway', 'Fly.io'];

    $features = [
        ['icon' => 'globe', 'title' => 'Edge Network', 'desc' => '300+ PoPs worldwide. Sub-20ms cold starts. Your users never wait — regardless of where they are.'],
        ['icon' => 'rotate-ccw', 'title' => 'Instant Rollbacks', 'desc' => 'Every deploy is immutable. Roll back to any point in your history with a single command.'],
        ['icon' => 'git-branch', 'title' => 'Preview Deploys', 'desc' => 'Every pull request gets its own live URL. Share it with your team before you merge.'],
        ['icon' => 'terminal', 'title' => 'Real-time Logs', 'desc' => 'Stream logs from any deployment or function invocation directly in your terminal.'],
        ['icon' => 'shield', 'title' => 'DDoS Protection', 'desc' => 'Layer 3/4/7 mitigation at the edge. Rate-limiting, bot scoring, and WAF included.'],
        ['icon' => 'zap', 'title' => 'Zero-config CI', 'desc' => 'Push to any branch. Forge detects your framework and builds it — no YAML required.'],
    ];

    $codeTabs = [
        'js' => ['label' => 'JavaScript', 'lang' => 'js', 'filename' => 'deploy.js'],
        'python' => ['label' => 'Python', 'lang' => 'python', 'filename' => 'deploy.py'],
        'go' => ['label' => 'Go', 'lang' => 'go', 'filename' => 'deploy.go'],
        'curl' => ['label' => 'cURL', 'lang' => 'bash', 'filename' => 'deploy.sh'],
    ];

    $codeSnippets = [
        'js' => 'import { ForgeClient } from \'@forge/sdk\';

const forge = new ForgeClient({
  token: process.env.FORGE_TOKEN,
});

const deploy = await forge.deployments.create({
  projectId: \'proj_xK9m2pQr\',
  ref: \'main\',
  env: {
    NODE_ENV: \'production\',
    DATABASE_URL: process.env.DATABASE_URL,
  },
});

console.log(`Deployed: ${deploy.url}`);
// → https://myapp-a1b2c3.forge.sh',

        'python' => 'from forge import ForgeClient
import os

client = ForgeClient(token=os.environ["FORGE_TOKEN"])

deployment = client.deployments.create(
    project_id="proj_xK9m2pQr",
    ref="main",
    env={
        "NODE_ENV": "production",
        "DATABASE_URL": os.environ["DATABASE_URL"],
    },
)

print(f"Deployed: {deployment.url}")
# → https://myapp-a1b2c3.forge.sh',

        'go' => 'package main

import (
    "fmt"
    "os"

    forge "github.com/forge-dev/forge-go"
)

func main() {
    client := forge.NewClient(os.Getenv("FORGE_TOKEN"))

    dep, err := client.Deployments.Create(forge.DeployInput{
        ProjectID: "proj_xK9m2pQr",
        Ref:       "main",
        Env: map[string]string{
            "NODE_ENV":     "production",
            "DATABASE_URL": os.Getenv("DATABASE_URL"),
        },
    })
    if err != nil {
        panic(err)
    }
    fmt.Printf("Deployed: %s\n", dep.URL)
}',

        'curl' => 'curl -X POST https://api.forge.sh/v1/deployments \
  -H "Authorization: Bearer $FORGE_TOKEN" \
  -H "Content-Type: application/json" \
  -d \'{
    "projectId": "proj_xK9m2pQr",
    "ref": "main",
    "env": {
      "NODE_ENV": "production"
    }
  }\'

# Response:
# {
#   "id": "dep_7fHqzRmN",
#   "url": "https://myapp-a1b2c3.forge.sh",
#   "state": "BUILDING",
#   "createdAt": "2026-06-11T09:41:00Z"
# }',
    ];

    $metrics = [
        ['label' => 'Global Uptime', 'value' => 99.99, 'display' => '99.99%', 'tone' => 'success'],
        ['label' => 'P99 Latency (ms)', 'value' => 82, 'display' => '18ms P99', 'tone' => 'success'],
        ['label' => 'Build Success Rate', 'value' => 98.7, 'display' => '98.7%', 'tone' => 'success'],
        ['label' => 'CDN Cache Hit Rate', 'value' => 94, 'display' => '94%', 'tone' => 'warning'],
    ];

    $plans = [
        ['name' => 'Hobby', 'm' => 0, 'y' => 0, 'tag' => 'Personal projects', 'cta' => 'Start free', 'highlight' => false,
            'features' => ['3 projects', '100 GB bandwidth/mo', 'Preview deploys', 'Community support', 'Custom domains']],
        ['name' => 'Pro', 'm' => 20, 'y' => 16, 'tag' => 'Professional teams', 'cta' => 'Start trial', 'highlight' => true,
            'features' => ['Unlimited projects', '1 TB bandwidth/mo', 'Team access (5 seats)', 'Priority support', 'Environment secrets', 'Analytics']],
        ['name' => 'Enterprise', 'm' => 0, 'y' => 0, 'tag' => 'Scale & compliance', 'cta' => 'Contact us', 'highlight' => false,
            'features' => ['Unlimited everything', 'SLA 99.99%', 'SSO / SAML', 'Audit logs', 'Dedicated infra', 'Custom contracts']],
    ];

    $compare = [
        ['feature' => 'Custom domains', 'hobby' => true, 'pro' => true, 'ent' => true],
        ['feature' => 'Preview deploys', 'hobby' => true, 'pro' => true, 'ent' => true],
        ['feature' => 'Rollbacks', 'hobby' => '3 days', 'pro' => 'Unlimited', 'ent' => 'Unlimited'],
        ['feature' => 'Team seats', 'hobby' => '1', 'pro' => '5', 'ent' => 'Unlimited'],
        ['feature' => 'Bandwidth', 'hobby' => '100 GB', 'pro' => '1 TB', 'ent' => 'Custom'],
        ['feature' => 'SSO / SAML', 'hobby' => false, 'pro' => false, 'ent' => true],
        ['feature' => 'Audit logs', 'hobby' => false, 'pro' => false, 'ent' => true],
        ['feature' => 'SLA', 'hobby' => false, 'pro' => '99.9%', 'ent' => '99.99%'],
    ];

    $faqs = [
        ['q' => 'How does billing work?', 'a' => 'Hobby is free forever. Pro is $20/mo (or $16/mo billed annually). You only pay once per workspace — adding more teammates does not increase your bill.'],
        ['q' => 'Can I migrate from another platform?', 'a' => 'Yes. Run `npx forge migrate` in your project root. Forge detects your existing config (env vars, build commands, domains) and imports it automatically.'],
        ['q' => 'How do preview deploys work?', 'a' => 'Every pull request and branch push triggers a fresh build on an isolated URL. Once you merge or close the PR, Forge automatically cleans up the environment.'],
        ['q' => 'What runtimes are supported?', 'a' => 'Node.js (20, 22), Python (3.11, 3.12), Go (1.22+), Bun, Deno, and static sites. Edge Functions run on our V8 isolate runtime for sub-millisecond cold starts.'],
        ['q' => 'Is there a CLI?', 'a' => 'Yes — `npm i -g @forge/cli`. It covers deploys, logs, env, rollbacks and secrets. It also ships a local dev server that mirrors the edge environment exactly.'],
    ];

    $footer = [
        'Product'   => ['Features', 'Integrations', 'Changelog', 'Roadmap', 'Status'],
        'Developers' => ['Docs', 'CLI Reference', 'SDK', 'API Reference', 'Templates'],
        'Company'   => ['About', 'Blog', 'Careers', 'Customers', 'Contact'],
        'Legal'     => ['Privacy', 'Terms', 'Security', 'DPA', 'Cookies'],
    ];
@endphp

<x-layouts.app title="Forge — Ship faster. Sleep better.">

<style>
    @import url('https://fonts.bunny.net/css?family=jetbrains-mono:400,500,700');

    #tpl-forge {
        /* Completely self-contained color surface — immune to site theme toggle */
        --fg-forge:        #e6edf3;
        --fg-muted:        #7d8590;
        --bg-base:         #0b0e14;
        --bg-panel:        #161b22;
        --bg-panel-2:      #0d1117;
        --border:          #21262d;
        --accent-green:    #3fb950;
        --accent-cyan:     #39c5cf;
        --accent-amber:    #d29922;

        background-color: var(--bg-base);
        color: var(--fg-forge);
        font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        --radius: 0.5rem;
    }

    #tpl-forge .forge-mono {
        font-family: 'JetBrains Mono', 'Fira Code', ui-monospace, monospace;
    }

    /* Dotted-grid background */
    #tpl-forge .forge-grid-bg {
        background-image: radial-gradient(circle, #21262d 1px, transparent 1px);
        background-size: 24px 24px;
    }

    /* Gradient hairline borders */
    #tpl-forge .forge-card {
        background: var(--bg-panel);
        border-radius: var(--radius);
        position: relative;
    }
    #tpl-forge .forge-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: var(--radius);
        padding: 1px;
        background: linear-gradient(135deg, #3fb95040 0%, #21262d 50%, #39c5cf30 100%);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    /* Terminal window */
    #tpl-forge .forge-terminal {
        background: #090d12;
        border: 1px solid var(--border);
        border-radius: 0.625rem;
        overflow: hidden;
        box-shadow: 0 0 0 1px #ffffff08, 0 32px 80px #000000a0;
    }
    #tpl-forge .forge-terminal-titlebar {
        background: #111722;
        border-bottom: 1px solid var(--border);
        padding: 0.6rem 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    #tpl-forge .forge-traffic { width: 0.75rem; height: 0.75rem; border-radius: 50%; }
    #tpl-forge .forge-traffic-red    { background: #ff5f57; }
    #tpl-forge .forge-traffic-amber  { background: #febc2e; }
    #tpl-forge .forge-traffic-green  { background: #28c840; }
    #tpl-forge .forge-terminal-body {
        padding: 1rem 1.125rem;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.78rem;
        line-height: 1.7;
        color: var(--fg-forge);
    }
    #tpl-forge .forge-prompt { color: var(--accent-green); }
    #tpl-forge .forge-cmd    { color: #e6edf3; }
    #tpl-forge .forge-out-dim  { color: var(--fg-muted); }
    #tpl-forge .forge-out-ok   { color: var(--accent-green); }
    #tpl-forge .forge-out-cyan { color: var(--accent-cyan); }
    #tpl-forge .forge-out-amber { color: var(--accent-amber); }

    /* Blinking caret */
    @keyframes forge-caret-blink {
        0%, 49% { opacity: 1; }
        50%, 100% { opacity: 0; }
    }
    #tpl-forge .forge-caret {
        display: inline-block;
        width: 0.5ch;
        height: 1.1em;
        background: var(--accent-green);
        vertical-align: text-bottom;
        animation: forge-caret-blink 1.1s step-end infinite;
    }
    @media (prefers-reduced-motion: reduce) {
        #tpl-forge .forge-caret { animation: none; opacity: 1; }
    }

    /* CTA glow */
    #tpl-forge .forge-glow-btn {
        box-shadow: 0 0 24px #3fb95050, 0 0 8px #3fb95030;
        transition: box-shadow 0.2s ease;
    }
    #tpl-forge .forge-glow-btn:hover {
        box-shadow: 0 0 36px #3fb95080, 0 0 12px #3fb95050;
    }

    /* Metric progress bars */
    #tpl-forge .forge-progress-track {
        background: #21262d;
        height: 6px;
        border-radius: 9999px;
        overflow: hidden;
    }
    #tpl-forge .forge-progress-bar {
        height: 100%;
        border-radius: 9999px;
        background: var(--accent-green);
        transition: width 0.6s ease;
    }
    #tpl-forge .forge-progress-bar.amber { background: var(--accent-amber); }

    /* Section label */
    #tpl-forge .forge-section-label {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--accent-green);
    }

    /* Comparison table */
    #tpl-forge .forge-compare-table th,
    #tpl-forge .forge-compare-table td {
        border-color: var(--border);
    }
    #tpl-forge .forge-compare-table tbody tr:hover td {
        background: #161b2260;
    }

    /* Override BlatUI component colors inside forge for the accordion + tabs */
    #tpl-forge [data-slot='accordion-item'] {
        border-color: var(--border) !important;
    }
    #tpl-forge [data-slot='accordion-trigger'] {
        color: var(--fg-forge) !important;
    }
    #tpl-forge [data-slot='accordion-content'] {
        color: var(--fg-muted) !important;
    }
    #tpl-forge [data-slot='tabs-list'] {
        background: #0d1117 !important;
    }
    #tpl-forge [data-slot='tabs-trigger'][data-state='active'] {
        background: var(--bg-panel) !important;
        color: var(--fg-forge) !important;
    }
    #tpl-forge [data-slot='tabs-trigger'] {
        color: var(--fg-muted) !important;
    }
    #tpl-forge [data-slot='code-block'] {
        border-color: var(--border) !important;
    }
    #tpl-forge [data-slot='separator'] {
        background: var(--border) !important;
    }

    /* Pricing card highlight override */
    #tpl-forge .forge-plan-highlight {
        box-shadow: 0 0 0 1px var(--accent-green), 0 0 24px #3fb95025;
    }

    /* Animate stagger for terminal lines */
    @keyframes forge-fadein {
        from { opacity: 0; transform: translateY(3px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    #tpl-forge .forge-line { animation: forge-fadein 0.25s ease both; }
    #tpl-forge .forge-line:nth-child(1) { animation-delay: 0.1s; }
    #tpl-forge .forge-line:nth-child(2) { animation-delay: 0.35s; }
    #tpl-forge .forge-line:nth-child(3) { animation-delay: 0.6s; }
    #tpl-forge .forge-line:nth-child(4) { animation-delay: 0.85s; }
    #tpl-forge .forge-line:nth-child(5) { animation-delay: 1.1s; }
    #tpl-forge .forge-line:nth-child(6) { animation-delay: 1.35s; }
    #tpl-forge .forge-line:nth-child(7) { animation-delay: 1.6s; }
    #tpl-forge .forge-line:nth-child(8) { animation-delay: 1.85s; }
    @media (prefers-reduced-motion: reduce) {
        #tpl-forge .forge-line { animation: none; opacity: 1; }
    }

    /* Bento grid */
    #tpl-forge .forge-bento-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    @media (max-width: 900px) {
        #tpl-forge .forge-bento-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 560px) {
        #tpl-forge .forge-bento-grid { grid-template-columns: 1fr; }
    }
    #tpl-forge .forge-bento-wide { grid-column: span 2; }
    @media (max-width: 900px) {
        #tpl-forge .forge-bento-wide { grid-column: span 1; }
    }
</style>

<div id="tpl-forge">

    {{-- ============================================================ NAV ============================================================ --}}
    <header style="background:#0b0e14cc; border-bottom:1px solid #21262d; backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px);"
            class="sticky top-0 z-40">
        <div class="mx-auto flex h-14 max-w-6xl items-center gap-4 px-6">

            {{-- Wordmark --}}
            <a href="#" class="flex items-center gap-2.5 shrink-0" aria-label="Forge home">
                <span style="background:#3fb950; border-radius:6px;" class="flex size-7 items-center justify-center">
                    <x-lucide-zap class="size-4" style="color:#0b0e14;" />
                </span>
                <span class="forge-mono text-base font-semibold tracking-tight" style="color:#e6edf3;">forge</span>
            </a>

            <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label => $href)
                    <a href="{{ $href }}" class="rounded-md px-3 py-1.5 font-medium transition-colors"
                       style="color:#7d8590;" onmouseover="this.style.color='#e6edf3'" onmouseout="this.style.color='#7d8590'">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                {{-- GitHub star badge --}}
                <x-ui.tooltip>
                    <x-ui.tooltip-trigger>
                        <a href="#" class="hidden sm:inline-flex items-center gap-1.5 rounded-md border px-2.5 py-1 text-xs font-medium transition-colors"
                           style="border-color:#21262d; background:#161b22; color:#e6edf3;"
                           onmouseover="this.style.borderColor='#3fb95060'" onmouseout="this.style.borderColor='#21262d'">
                            <x-lucide-github class="size-3.5" />
                            <span class="forge-mono">24k</span>
                            <x-lucide-star class="size-3" style="color:#d29922; fill:#d29922;" />
                        </a>
                    </x-ui.tooltip-trigger>
                    <x-ui.tooltip-content>Star us on GitHub</x-ui.tooltip-content>
                </x-ui.tooltip>

                {{-- ⌘K hint --}}
                <x-ui.command-dialog title="Forge Command Palette" description="Search commands, docs and settings">
                    <x-slot:trigger>
                        <button type="button"
                                class="hidden sm:inline-flex items-center gap-2 rounded-md border px-2.5 py-1.5 text-xs transition-colors"
                                style="border-color:#21262d; background:#161b22; color:#7d8590;"
                                onmouseover="this.style.borderColor='#3fb95060'; this.style.color='#e6edf3'" onmouseout="this.style.borderColor='#21262d'; this.style.color='#7d8590'">
                            <x-lucide-search class="size-3" />
                            <span>Search</span>
                            <x-ui.kbd>⌘K</x-ui.kbd>
                        </button>
                    </x-slot:trigger>
                    <x-ui.command>
                        <x-ui.command-input placeholder="Search docs, commands..." />
                        <x-ui.command-list>
                            <x-ui.command-empty>No results found.</x-ui.command-empty>
                            <x-ui.command-group heading="Quick Actions">
                                <x-ui.command-item><x-lucide-rocket class="size-4" /><span>New deployment</span><x-ui.command-shortcut>⌘D</x-ui.command-shortcut></x-ui.command-item>
                                <x-ui.command-item><x-lucide-git-branch class="size-4" /><span>New project</span><x-ui.command-shortcut>⌘N</x-ui.command-shortcut></x-ui.command-item>
                                <x-ui.command-item><x-lucide-terminal class="size-4" /><span>Open terminal</span><x-ui.command-shortcut>⌘`</x-ui.command-shortcut></x-ui.command-item>
                            </x-ui.command-group>
                            <x-ui.command-separator />
                            <x-ui.command-group heading="Docs">
                                <x-ui.command-item><x-lucide-book-open class="size-4" /><span>Getting started</span></x-ui.command-item>
                                <x-ui.command-item><x-lucide-code class="size-4" /><span>API reference</span></x-ui.command-item>
                                <x-ui.command-item><x-lucide-box class="size-4" /><span>CLI reference</span></x-ui.command-item>
                            </x-ui.command-group>
                            <x-ui.command-separator />
                            <x-ui.command-group heading="Settings">
                                <x-ui.command-item><x-lucide-settings class="size-4" /><span>Project settings</span><x-ui.command-shortcut>⌘,</x-ui.command-shortcut></x-ui.command-item>
                                <x-ui.command-item><x-lucide-key class="size-4" /><span>API tokens</span></x-ui.command-item>
                                <x-ui.command-item><x-lucide-log-out class="size-4" /><span>Sign out</span></x-ui.command-item>
                            </x-ui.command-group>
                        </x-ui.command-list>
                    </x-ui.command>
                </x-ui.command-dialog>

                <x-ui.button href="#" variant="ghost" size="sm" style="color:#7d8590;">Sign in</x-ui.button>
                <x-ui.button href="#pricing" size="sm" class="forge-glow-btn"
                             style="background:#3fb950; color:#0b0e14; font-weight:600; border:none;">
                    Get started
                    <x-lucide-arrow-right class="size-4" />
                </x-ui.button>
            </div>
        </div>
    </header>

    {{-- ============================================================ HERO ============================================================ --}}
    <section class="relative overflow-hidden" style="border-bottom:1px solid #21262d;">
        <div class="forge-grid-bg absolute inset-0 opacity-50 pointer-events-none"></div>
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-0 flex justify-center">
            <div style="width:44rem; height:22rem; border-radius:9999px; background:radial-gradient(ellipse, #3fb95018 0%, transparent 70%); filter:blur(40px);"></div>
        </div>

        <div class="relative mx-auto grid max-w-6xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28 z-10">
            <div>
                <div class="mb-5 inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-medium"
                     style="border-color:#3fb95040; background:#3fb95010; color:#3fb950;">
                    <span class="inline-block size-1.5 rounded-full bg-current animate-pulse"></span>
                    <span class="forge-mono">v2.4.0 · Edge Functions GA</span>
                </div>

                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl" style="color:#e6edf3; line-height:1.12;">
                    Ship faster.<br />
                    <span style="color:#3fb950;">Sleep</span> better.
                </h1>
                <p class="mt-5 max-w-lg text-lg" style="color:#7d8590; line-height:1.65;">
                    Forge is the deploy platform built for engineers who care about speed and reliability.
                    Push code, get a URL in seconds — globally distributed, instantly scalable.
                </p>

                {{-- Install command --}}
                <div class="mt-7">
                    <p class="forge-section-label mb-2">Get started in seconds</p>
                    <div class="flex items-center gap-2 rounded-lg border p-1 pr-2" style="border-color:#21262d; background:#0d1117; max-width:340px;">
                        <div class="flex items-center gap-2 pl-3 flex-1 min-w-0">
                            <span class="forge-mono text-sm shrink-0" style="color:#3fb950;">$</span>
                            <span class="forge-mono text-sm truncate" style="color:#e6edf3;">npx forge deploy</span>
                        </div>
                        <x-ui.copy-button value="npx forge deploy" class="shrink-0 h-7 rounded"
                                          style="color:#7d8590; background:transparent;" />
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <x-ui.button href="#pricing" size="lg" class="forge-glow-btn"
                                 style="background:#3fb950; color:#0b0e14; font-weight:700; border:none;">
                        Deploy for free
                        <x-lucide-arrow-right class="size-4" />
                    </x-ui.button>
                    <x-ui.button href="#code" size="lg" variant="outline"
                                 style="border-color:#21262d; background:#161b22; color:#e6edf3;">
                        <x-lucide-book-open class="size-4" />
                        Read the docs
                    </x-ui.button>
                </div>

                {{-- Micro stats --}}
                <div class="mt-8 flex flex-wrap gap-5">
                    @foreach ([['24k', 'GitHub stars'], ['300+', 'Edge PoPs'], ['99.99%', 'Uptime SLA']] as [$v, $l])
                        <div>
                            <div class="forge-mono text-xl font-bold" style="color:#e6edf3;">{{ $v }}</div>
                            <div class="text-xs" style="color:#7d8590;">{{ $l }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Terminal mockup --}}
            <div class="relative">
                <div class="forge-terminal">
                    <div class="forge-terminal-titlebar">
                        <span class="forge-traffic forge-traffic-red"></span>
                        <span class="forge-traffic forge-traffic-amber"></span>
                        <span class="forge-traffic forge-traffic-green"></span>
                        <span class="ml-3 text-xs" style="color:#7d8590; font-family:'JetBrains Mono',monospace;">forge — deploy — 80×24</span>
                    </div>
                    <div class="forge-terminal-body">
                        <div class="forge-line"><span class="forge-prompt">~/myapp $</span> <span class="forge-cmd">npx forge deploy</span></div>
                        <div class="forge-line"><span class="forge-out-dim">  Detecting framework...</span></div>
                        <div class="forge-line"><span class="forge-out-ok">✓</span> <span class="forge-out-dim">Next.js 14 detected</span></div>
                        <div class="forge-line"><span class="forge-out-ok">✓</span> <span class="forge-out-dim">Building (23s)</span></div>
                        <div class="forge-line"><span class="forge-out-ok">✓</span> <span class="forge-out-dim">Uploading 312 assets</span></div>
                        <div class="forge-line"><span class="forge-out-ok">✓</span> <span class="forge-out-dim">Propagating to edge (300 PoPs)</span></div>
                        <div class="forge-line">
                            <span class="forge-out-ok">✓</span>
                            <span style="color:#e6edf3;"> Deployed in </span>
                            <span class="forge-out-amber font-semibold">31s</span>
                        </div>
                        <div class="forge-line">
                            <span class="forge-out-dim">  Live at </span>
                            <span class="forge-out-cyan">https://myapp-a1b2c3.forge.sh</span>
                        </div>
                        <div class="forge-line mt-1">
                            <span class="forge-prompt">~/myapp $</span>
                            <span class="forge-cmd"> </span><span class="forge-caret" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                {{-- Decorative glow behind terminal --}}
                <div class="absolute -inset-4 -z-10 opacity-30 pointer-events-none"
                     style="background:radial-gradient(ellipse at 60% 50%, #3fb95020 0%, transparent 70%); border-radius:1.5rem;"></div>
            </div>
        </div>
    </section>

    {{-- ============================================================ LOGO WALL ============================================================ --}}
    <section style="border-bottom:1px solid #21262d;" class="py-10">
        <p class="forge-section-label mb-6 text-center">Trusted by engineering teams at</p>
        <x-ui.marquee fade :duration="'38s'" class="mx-auto max-w-5xl">
            @foreach ($logos as $name)
                <span class="forge-mono px-6 text-sm font-medium whitespace-nowrap" style="color:#7d8590;">{{ $name }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ============================================================ FEATURES BENTO ============================================================ --}}
    <section id="features" class="py-20 lg:py-28 scroll-mt-20" style="border-bottom:1px solid #21262d;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 text-center">
                <p class="forge-section-label mb-3">What you get</p>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="color:#e6edf3;">
                    Engineered for zero-downtime teams
                </h2>
                <p class="mt-3 max-w-xl mx-auto text-base" style="color:#7d8590;">
                    Every feature is a building block. Use just the ones you need, or let Forge run your entire delivery pipeline.
                </p>
            </div>

            <div class="forge-bento-grid">
                {{-- Wide first card --}}
                <div class="forge-card forge-bento-wide p-6 flex items-start gap-5">
                    <div class="shrink-0 flex size-12 items-center justify-center rounded-lg"
                         style="background:#3fb95015; border:1px solid #3fb95030;">
                        <x-lucide-globe class="size-6" style="color:#3fb950;" />
                    </div>
                    <div>
                        <h3 class="font-semibold text-base mb-1" style="color:#e6edf3;">Edge Network — 300+ PoPs worldwide</h3>
                        <p class="text-sm" style="color:#7d8590;">
                            Your code runs at the edge, not in a single data centre. Sub-20ms cold starts, automatic geo-routing, and built-in DDoS mitigation.
                            Forge handles the infrastructure — you focus on the code.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach (['Sub-20ms cold start', 'Auto geo-routing', 'HTTP/3 + QUIC', 'Layer 7 WAF'] as $tag)
                                <x-ui.badge tone="neutral" variant="outline" class="forge-mono text-[10px]"
                                            style="border-color:#21262d; color:#7d8590;">{{ $tag }}</x-ui.badge>
                            @endforeach
                        </div>
                    </div>
                </div>

                @foreach (array_slice($features, 1) as $f)
                    <div class="forge-card p-5 flex flex-col gap-3">
                        <div class="flex size-10 items-center justify-center rounded-lg"
                             style="background:#3fb95015; border:1px solid #3fb95030;">
                            <x-dynamic-component :component="'lucide-'.$f['icon']" class="size-5" style="color:#3fb950;" />
                        </div>
                        <h3 class="font-semibold text-sm" style="color:#e6edf3;">{{ $f['title'] }}</h3>
                        <p class="text-xs leading-relaxed" style="color:#7d8590;">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================ CODE SHOWCASE ============================================================ --}}
    <section id="code" class="py-20 lg:py-28 scroll-mt-20" style="border-bottom:1px solid #21262d;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="grid items-start gap-12 lg:grid-cols-2">
                <div>
                    <p class="forge-section-label mb-3">API / SDK</p>
                    <h2 class="text-3xl font-bold tracking-tight mb-4" style="color:#e6edf3;">Deploy from any language</h2>
                    <p class="text-base mb-6" style="color:#7d8590;">
                        Official SDKs for JavaScript, Python, and Go. A dead-simple REST API if you need to call Forge from anywhere else. Every endpoint is idempotent — safe to call from CI.
                    </p>
                    <ul class="space-y-3">
                        @foreach (['Full TypeScript types', 'Auto-retry with exponential backoff', 'Webhook events for every state change', 'OpenAPI 3.1 spec always in sync'] as $point)
                            <li class="flex items-center gap-2.5 text-sm" style="color:#7d8590;">
                                <x-lucide-check class="size-4 shrink-0" style="color:#3fb950;" />
                                {{ $point }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-6 flex gap-2">
                        <x-ui.button href="#" variant="outline" size="sm"
                                     style="border-color:#21262d; background:#161b22; color:#e6edf3;">
                            <x-lucide-book-open class="size-3.5" />
                            Full API docs
                        </x-ui.button>
                        <x-ui.button href="#" variant="ghost" size="sm" style="color:#7d8590;">
                            <x-lucide-github class="size-3.5" />
                            View on GitHub
                        </x-ui.button>
                    </div>
                </div>

                <div>
                    <x-ui.tabs value="js" class="w-full gap-0">
                        <x-ui.tabs-list class="rounded-b-none w-full justify-start" style="background:#0d1117; border:1px solid #21262d; border-bottom:none; border-radius:0.5rem 0.5rem 0 0; padding:0.5rem 0.5rem 0;">
                            @foreach ($codeTabs as $key => $tab)
                                <x-ui.tabs-trigger value="{{ $key }}" class="forge-mono text-xs px-3 py-1.5 h-8 rounded-t-md rounded-b-none">
                                    {{ $tab['label'] }}
                                </x-ui.tabs-trigger>
                            @endforeach
                        </x-ui.tabs-list>
                        @foreach ($codeTabs as $key => $tab)
                            <x-ui.tabs-content value="{{ $key }}" class="mt-0">
                                <x-ui.code-block filename="{{ $tab['filename'] }}" class="rounded-t-none">{{ $codeSnippets[$key] }}</x-ui.code-block>
                            </x-ui.tabs-content>
                        @endforeach
                    </x-ui.tabs>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ COMMAND PALETTE TEASER ============================================================ --}}
    <section class="py-20 lg:py-24" style="border-bottom:1px solid #21262d; background:#0d1117;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <p class="forge-section-label mb-3">⌘K palette</p>
                    <h2 class="text-3xl font-bold tracking-tight mb-4" style="color:#e6edf3;">Your entire platform, one keystroke away</h2>
                    <p class="text-base mb-6" style="color:#7d8590;">
                        Press <x-ui.kbd>⌘</x-ui.kbd><x-ui.kbd>K</x-ui.kbd> anywhere in the Forge dashboard to
                        instantly jump to any project, trigger a deploy, inspect logs, or run a CLI command — without
                        ever reaching for the mouse.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Deploy', 'Rollback', 'View logs', 'Env vars', 'Team settings', 'API tokens'] as $action)
                            <span class="inline-flex items-center gap-1.5 rounded-md border px-2.5 py-1 text-xs"
                                  style="border-color:#21262d; background:#161b22; color:#7d8590; font-family:'JetBrains Mono',monospace;">
                                {{ $action }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Inline command palette preview (static, read-only) --}}
                <div class="forge-card overflow-hidden" style="max-width:420px;">
                    <x-ui.command>
                        <x-ui.command-input placeholder="Search commands, projects..." />
                        <x-ui.command-list>
                            <x-ui.command-empty>No results found.</x-ui.command-empty>
                            <x-ui.command-group heading="Quick deploy">
                                <x-ui.command-item value="deploy main">
                                    <x-lucide-rocket class="size-4" style="color:#3fb950;" />
                                    <span>Deploy · main</span>
                                    <x-ui.command-shortcut>⌘↵</x-ui.command-shortcut>
                                </x-ui.command-item>
                                <x-ui.command-item value="rollback last">
                                    <x-lucide-rotate-ccw class="size-4" />
                                    <span>Rollback to previous</span>
                                    <x-ui.command-shortcut>⌘Z</x-ui.command-shortcut>
                                </x-ui.command-item>
                                <x-ui.command-item value="open logs">
                                    <x-lucide-terminal class="size-4" />
                                    <span>Stream live logs</span>
                                    <x-ui.command-shortcut>⌘L</x-ui.command-shortcut>
                                </x-ui.command-item>
                            </x-ui.command-group>
                            <x-ui.command-separator />
                            <x-ui.command-group heading="Navigate">
                                <x-ui.command-item value="projects list">
                                    <x-lucide-layers class="size-4" />
                                    <span>All projects</span>
                                </x-ui.command-item>
                                <x-ui.command-item value="env vars">
                                    <x-lucide-key class="size-4" />
                                    <span>Environment variables</span>
                                </x-ui.command-item>
                                <x-ui.command-item value="team settings">
                                    <x-lucide-users class="size-4" />
                                    <span>Team settings</span>
                                </x-ui.command-item>
                            </x-ui.command-group>
                        </x-ui.command-list>
                    </x-ui.command>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ METRICS ============================================================ --}}
    <section class="py-20 lg:py-28" style="border-bottom:1px solid #21262d;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 text-center">
                <p class="forge-section-label mb-3">Reliability</p>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="color:#e6edf3;">Built to stay up</h2>
                <p class="mt-3 max-w-xl mx-auto text-sm" style="color:#7d8590;">
                    Real numbers from our last 90 days. We publish our status page publicly so you can always verify.
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($metrics as $m)
                    <div class="forge-card p-5 flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-medium" style="color:#7d8590;">{{ $m['label'] }}</span>
                            <x-ui.badge tone="{{ $m['tone'] }}" variant="soft" class="forge-mono text-[10px]">
                                {{ $m['display'] }}
                            </x-ui.badge>
                        </div>
                        <div class="forge-progress-track">
                            <div class="forge-progress-bar {{ $m['tone'] === 'warning' ? 'amber' : '' }}"
                                 style="width:{{ $m['value'] }}%;"></div>
                        </div>
                        <span class="forge-mono text-2xl font-bold" style="color:#e6edf3;">{{ $m['display'] }}</span>
                    </div>
                @endforeach
            </div>

            {{-- Status row --}}
            <div class="mt-8 flex items-center justify-center gap-3 flex-wrap">
                <span class="inline-flex items-center gap-1.5 text-sm" style="color:#3fb950;">
                    <span class="inline-block size-2 rounded-full bg-current animate-pulse"></span>
                    All systems operational
                </span>
                <x-ui.separator orientation="vertical" class="h-4" />
                <span class="text-xs" style="color:#7d8590;">Last incident: 92 days ago</span>
                <x-ui.separator orientation="vertical" class="h-4" />
                <a href="#" class="text-xs hover:underline" style="color:#39c5cf;">View status page →</a>
            </div>
        </div>
    </section>

    {{-- ============================================================ PRICING ============================================================ --}}
    <section id="pricing" class="py-20 lg:py-28 scroll-mt-20" style="border-bottom:1px solid #21262d; background:#0d1117;">
        <div class="mx-auto max-w-6xl px-6" x-data="{ yearly: false }">
            <div class="mb-10 text-center">
                <p class="forge-section-label mb-3">Pricing</p>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="color:#e6edf3;">Straightforward pricing</h2>
                <p class="mt-3 text-base" style="color:#7d8590;">No per-seat fees. No surprise bills. Just flat-rate workspace pricing.</p>

                {{-- Billing toggle --}}
                <div class="mt-6 inline-flex items-center gap-3 rounded-lg border p-1 text-sm"
                     style="border-color:#21262d; background:#161b22;">
                    <button type="button" @click="yearly = false"
                            :style="!yearly ? 'background:#21262d; color:#e6edf3;' : 'color:#7d8590; background:transparent;'"
                            class="rounded-md px-3 py-1.5 font-medium transition-all forge-mono text-xs">
                        Monthly
                    </button>
                    <x-ui.switch x-bind:checked="yearly" @click="yearly = !yearly" size="sm" />
                    <button type="button" @click="yearly = true"
                            :style="yearly ? 'background:#21262d; color:#e6edf3;' : 'color:#7d8590; background:transparent;'"
                            class="rounded-md px-3 py-1.5 font-medium transition-all forge-mono text-xs inline-flex items-center gap-1.5">
                        Yearly <x-ui.badge tone="success" variant="soft" class="text-[10px]">−20%</x-ui.badge>
                    </button>
                </div>
            </div>

            <div class="grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div class="forge-card p-6 flex flex-col {{ $plan['highlight'] ? 'forge-plan-highlight' : '' }}">
                        @if ($plan['highlight'])
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 pointer-events-none">
                                <x-ui.badge class="forge-mono text-[10px]"
                                            style="background:#3fb950; color:#0b0e14; border:none; font-weight:700;">
                                    Most popular
                                </x-ui.badge>
                            </div>
                        @endif

                        <h3 class="text-base font-semibold forge-mono" style="color:#e6edf3;">{{ $plan['name'] }}</h3>
                        <p class="text-xs mt-0.5" style="color:#7d8590;">{{ $plan['tag'] }}</p>

                        <div class="mt-4 flex items-baseline gap-1">
                            @if ($plan['m'] === 0 && $plan['name'] !== 'Pro')
                                <span class="text-3xl font-bold tracking-tight forge-mono" style="color:#e6edf3;">
                                    {{ $plan['name'] === 'Hobby' ? 'Free' : 'Custom' }}
                                </span>
                            @else
                                <span class="text-3xl font-bold tracking-tight forge-mono" style="color:#e6edf3;">
                                    $<span x-text="yearly ? {{ $plan['y'] }} : {{ $plan['m'] }}">{{ $plan['m'] }}</span>
                                </span>
                                <span class="text-xs" style="color:#7d8590;">/mo</span>
                            @endif
                        </div>

                        <div class="mt-5">
                            <x-ui.button href="#" class="w-full"
                                         style="{{ $plan['highlight'] ? 'background:#3fb950; color:#0b0e14; border:none; font-weight:700;' : 'background:#161b22; border-color:#21262d; color:#e6edf3;' }}"
                                         variant="{{ $plan['highlight'] ? 'default' : 'outline' }}">
                                {{ $plan['cta'] }}
                            </x-ui.button>
                        </div>

                        <x-ui.separator class="my-5" />

                        <ul class="space-y-2.5 text-sm flex-1">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-start gap-2.5" style="color:#7d8590;">
                                    <x-lucide-check class="size-4 shrink-0 mt-0.5" style="color:#3fb950;" />
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================ COMPARISON TABLE ============================================================ --}}
    <section class="py-20 lg:py-24" style="border-bottom:1px solid #21262d;">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-10 text-center">
                <p class="forge-section-label mb-3">Compare</p>
                <h2 class="text-2xl font-bold tracking-tight" style="color:#e6edf3;">Plan comparison</h2>
            </div>

            <div class="overflow-x-auto rounded-xl border forge-compare-table" style="border-color:#21262d;">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="border-bottom:1px solid #21262d; background:#161b22;">
                            <th class="text-left py-3 px-4 font-medium" style="color:#7d8590; width:40%;">Feature</th>
                            @foreach (['Hobby', 'Pro', 'Enterprise'] as $tier)
                                <th class="text-center py-3 px-4 font-semibold forge-mono text-xs {{ $tier === 'Pro' ? '' : '' }}"
                                    style="{{ $tier === 'Pro' ? 'color:#3fb950;' : 'color:#e6edf3;' }}">
                                    {{ $tier }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compare as $i => $row)
                            <tr style="{{ $i % 2 === 1 ? 'background:#0d1117;' : '' }} border-bottom: 1px solid #21262d;" class="border-b last:border-b-0">
                                <td class="py-3 px-4" style="color:#7d8590; border-color:#21262d;">{{ $row['feature'] }}</td>
                                @foreach (['hobby', 'pro', 'ent'] as $col)
                                    <td class="py-3 px-4 text-center" style="color:#e6edf3; border-color:#21262d;">
                                        @if ($row[$col] === true)
                                            <x-lucide-check class="size-4 mx-auto" style="color:#3fb950;" />
                                        @elseif ($row[$col] === false)
                                            <x-lucide-minus class="size-4 mx-auto" style="color:#21262d;" />
                                        @else
                                            <span class="forge-mono text-xs">{{ $row[$col] }}</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ============================================================ FAQ ============================================================ --}}
    <section id="faq" class="py-20 lg:py-28 scroll-mt-20" style="border-bottom:1px solid #21262d; background:#0d1117;">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-10 text-center">
                <p class="forge-section-label mb-3">FAQ</p>
                <h2 class="text-3xl font-bold tracking-tight" style="color:#e6edf3;">Common questions</h2>
            </div>
            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}">
                        <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    {{-- ============================================================ CTA ============================================================ --}}
    <section class="py-20 lg:py-28" style="border-bottom:1px solid #21262d;">
        <div class="mx-auto max-w-5xl px-6">
            <div class="relative overflow-hidden rounded-2xl p-10 text-center lg:p-16"
                 style="background:#161b22; border:1px solid #21262d;">

                {{-- Dotted grid inside CTA --}}
                <div class="forge-grid-bg absolute inset-0 opacity-40 pointer-events-none"></div>

                {{-- Green glow --}}
                <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                    <div style="width:28rem; height:14rem; border-radius:9999px; background:radial-gradient(ellipse, #3fb95018 0%, transparent 70%); filter:blur(30px);"></div>
                </div>

                <div class="relative z-10">
                    <div class="mb-5 inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs"
                         style="border-color:#3fb95040; background:#3fb95010; color:#3fb950;">
                        <x-lucide-rocket class="size-3.5" />
                        <span class="forge-mono">Free to start · No credit card</span>
                    </div>

                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="color:#e6edf3;">
                        Start deploying in under 60 seconds
                    </h2>
                    <p class="mx-auto mt-3 max-w-xl text-base" style="color:#7d8590;">
                        Import a Git repo, connect a domain, and go live. Forge handles the rest.
                    </p>

                    <div class="mx-auto mt-7 flex items-center gap-2 rounded-lg border p-1 pr-2"
                         style="border-color:#21262d; background:#0d1117; max-width:340px;">
                        <div class="flex items-center gap-2 pl-3 flex-1 min-w-0">
                            <span class="forge-mono text-sm shrink-0" style="color:#3fb950;">$</span>
                            <span class="forge-mono text-sm truncate" style="color:#e6edf3;">npx forge init</span>
                        </div>
                        <x-ui.copy-button value="npx forge init" class="shrink-0 h-7 rounded"
                                          style="color:#7d8590; background:transparent;" />
                    </div>

                    <div class="mt-6 flex flex-wrap justify-center gap-3">
                        <x-ui.button href="#" size="lg" class="forge-glow-btn"
                                     style="background:#3fb950; color:#0b0e14; border:none; font-weight:700;">
                            Deploy your first project
                            <x-lucide-arrow-right class="size-4" />
                        </x-ui.button>
                        <x-ui.button href="#" size="lg" variant="outline"
                                     style="border-color:#21262d; background:transparent; color:#e6edf3;">
                            <x-lucide-github class="size-4" />
                            View on GitHub
                        </x-ui.button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ FOOTER ============================================================ --}}
    <footer style="border-top:1px solid #21262d;">
        <div class="mx-auto max-w-6xl px-6 py-14">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2.5" aria-label="Forge">
                        <span style="background:#3fb950; border-radius:6px;" class="flex size-7 items-center justify-center">
                            <x-lucide-zap class="size-4" style="color:#0b0e14;" />
                        </span>
                        <span class="forge-mono text-base font-semibold" style="color:#e6edf3;">forge</span>
                    </a>
                    <p class="mt-3 max-w-xs text-sm" style="color:#7d8590;">
                        The deploy platform built for engineers who ship every day.
                    </p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['github', 'twitter', 'linkedin', 'youtube'] as $soc)
                            <a href="#" aria-label="{{ $soc }}"
                               class="inline-flex size-8 items-center justify-center rounded-md border transition-colors"
                               style="border-color:#21262d; color:#7d8590; background:transparent;"
                               onmouseover="this.style.color='#e6edf3'; this.style.borderColor='#3fb95040';"
                               onmouseout="this.style.color='#7d8590'; this.style.borderColor='#21262d';">
                                <x-dynamic-component :component="'lucide-'.$soc" class="size-3.5" />
                            </a>
                        @endforeach
                    </div>
                </div>

                @foreach ($footer as $heading => $links)
                    <div>
                        <h3 class="forge-mono text-xs font-semibold uppercase tracking-widest mb-3" style="color:#e6edf3;">{{ $heading }}</h3>
                        <ul class="space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li>
                                    <a href="#" class="transition-colors" style="color:#7d8590;"
                                       onmouseover="this.style.color='#e6edf3'" onmouseout="this.style.color='#7d8590'">
                                        {{ $link }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" />

            <div class="flex flex-col items-center justify-between gap-3 text-xs sm:flex-row" style="color:#7d8590;">
                <span>© {{ date('Y') }} Forge, Inc. All rights reserved.</span>
                <div class="flex items-center gap-3">
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <span class="inline-flex items-center gap-1.5 cursor-default">
                                <x-lucide-shield class="size-3.5" style="color:#3fb950;" />
                                SOC 2 Type II
                            </span>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content side="top">Certified compliant · Last audit 2026-02-14</x-ui.tooltip-content>
                    </x-ui.tooltip>
                    <span style="color:#21262d;">·</span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-block size-1.5 rounded-full" style="background:#3fb950;"></span>
                        <a href="#" class="hover:underline" style="color:#7d8590;">All systems operational</a>
                    </span>
                </div>
            </div>
        </div>
    </footer>

</div>

</x-layouts.app>
