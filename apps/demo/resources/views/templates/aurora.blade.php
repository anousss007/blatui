@php
    $nav = ['Features' => '#features', 'Pricing' => '#pricing', 'Integrations' => '#integrations', 'Changelog' => '#faq'];

    $logos = ['Linear', 'Vercel', 'Stripe', 'Figma', 'Notion', 'Clerk', 'PlanetScale', 'Resend', 'Lemon Squeezy', 'Neon'];

    $features = [
        ['icon' => 'brain-circuit', 'title' => 'AI Copilot', 'desc' => 'An LLM-powered assistant that drafts, edits and explains your work in context — no context switching.', 'glow' => '#3b82f6'],
        ['icon' => 'workflow', 'title' => 'Smart Workflows', 'desc' => 'Chain actions across tools. Lumina handles the busywork so your team ships faster.', 'glow' => '#6366f1'],
        ['icon' => 'shield-check', 'title' => 'Zero-Trust Security', 'desc' => 'End-to-end encryption, SAML SSO, and a SOC 2 Type II audit log baked in from day one.', 'glow' => '#22d3ee'],
        ['icon' => 'zap', 'title' => 'Real-time Sync', 'desc' => 'Sub-100 ms live collaboration — every keystroke, every change, visible to the whole team instantly.', 'glow' => '#8b5cf6'],
        ['icon' => 'layers', 'title' => '120+ Integrations', 'desc' => 'Connect Slack, GitHub, Notion, Linear, Figma and a hundred more in two clicks.', 'glow' => '#ec4899'],
        ['icon' => 'chart-line', 'title' => 'Deep Analytics', 'desc' => 'Usage trends, team productivity scores, and AI-generated weekly digest — straight to your inbox.', 'glow' => '#3b82f6'],
    ];

    $spotlight = [
        'write'   => ['label' => 'Write',   'icon' => 'pen-line',      'title' => 'Write anything, faster', 'desc' => 'The AI copilot understands your workspace context — tone, terminology, linked documents — so every draft lands closer to done.', 'points' => ['In-context suggestions', 'Brand voice calibration', 'Multi-language support']],
        'analyze' => ['label' => 'Analyze', 'icon' => 'bar-chart-3',   'title' => 'Turn data into decisions', 'desc' => 'Ask questions in plain English. Get structured insights, charts, and recommended next steps — no SQL required.', 'points' => ['Natural language queries', 'Auto-generated summaries', 'Exportable reports']],
        'automate'=> ['label' => 'Automate','icon' => 'cpu',           'title' => 'Set it. Forget it.', 'desc' => 'Visual workflow builder with conditional branching, retries and a live event log. Ship automation pipelines in minutes.', 'points' => ['Visual drag-and-drop builder', 'Webhook + API triggers', 'Run-history & alerts']],
    ];

    $stats = [
        ['v' => '4.2M', 'l' => 'Documents created'],
        ['v' => '99.99%', 'l' => 'Uptime SLA'],
        ['v' => '<80ms', 'l' => 'Median latency'],
        ['v' => '4.9★', 'l' => 'Customer rating'],
    ];

    $testimonials = [
        ['q' => 'Lumina replaced our entire documentation stack overnight. The AI copilot alone saves our team four hours a week — and counting.', 'a' => 'Elena Marchetti', 'r' => 'Head of Product, Vercel', 'seed' => '101'],
        ['q' => 'The analytics are genuinely magical. I asked "what slowed us down last month?" and got a ranked list with charts in ten seconds.', 'a' => 'James Okafor', 'r' => 'CTO, Stripe', 'seed' => '202'],
        ['q' => "Security review passed first try. SAML, audit logs, zero-trust — it's all just there, production-ready out of the box.", 'a' => 'Sofia Lindqvist', 'r' => 'CISO, Linear', 'seed' => '303'],
        ['q' => 'We onboarded 80 people in a single afternoon. The UX is so clean nobody needed training, which has never happened before.', 'a' => 'Tomás Herrera', 'r' => 'VP Engineering, Figma', 'seed' => '404'],
    ];

    $plans = [
        ['name' => 'Starter',    'm' => 0,   'y' => 0,   'tag' => 'For solo builders', 'cta' => 'Start free',       'highlight' => false, 'features' => ['5 AI documents / mo', '1 workspace', 'Basic integrations', '7-day history', 'Community support']],
        ['name' => 'Pro',        'm' => 29,  'y' => 23,  'tag' => 'For growing teams',  'cta' => 'Start free trial', 'highlight' => true,  'features' => ['Unlimited AI docs', '10 workspaces', 'All integrations', '1-year history', 'Priority support', 'SSO & roles']],
        ['name' => 'Enterprise', 'm' => 99,  'y' => 79,  'tag' => 'For organisations',  'cta' => 'Talk to sales',    'highlight' => false, 'features' => ['Everything in Pro', 'Unlimited workspaces', 'SAML + SCIM', 'Audit logs', 'Dedicated CSM', 'SLA guarantee']],
    ];

    $faqs = [
        ['q' => 'How does the AI copilot work?',           'a' => 'Lumina embeds a context-aware language model directly in your workspace. It reads your linked documents, project terminology and past edits to surface suggestions that sound like you — not a generic AI.'],
        ['q' => 'Is there a free plan?',                   'a' => 'Yes — Starter is free forever with 5 AI documents per month and one workspace. No credit card required to sign up.'],
        ['q' => 'Can I use my own data region?',           'a' => 'Enterprise customers can pin their data to EU (Frankfurt), US (Virginia) or APAC (Singapore) regions. SOC 2 Type II and GDPR controls apply in all regions.'],
        ['q' => 'How does the annual billing discount work?', 'a' => 'Paying annually saves roughly 20 % vs the monthly rate. You can switch at any time; unused months are credited to your account.'],
        ['q' => 'What integrations are available on day one?', 'a' => 'Slack, GitHub, Notion, Linear, Figma, Jira, Confluence, Google Drive, Dropbox, and Zapier are all ready to connect. Custom webhooks and a REST API are available on every plan.'],
        ['q' => 'Do you offer a migration service?',       'a' => 'Pro and Enterprise customers get a complimentary migration audit and a 90-minute onboarding call with a Lumina solutions engineer.'],
    ];

    $footer = [
        'Product'   => ['Features', 'Integrations', 'Pricing', 'Changelog', 'Roadmap'],
        'Company'   => ['About', 'Careers', 'Blog', 'Press', 'Contact'],
        'Resources' => ['Documentation', 'API reference', 'Status', 'Community', 'Guides'],
        'Legal'     => ['Privacy', 'Terms', 'Security', 'DPA', 'Cookies'],
    ];
@endphp

<x-layouts.app title="Lumina — The AI workspace">

{{-- ============================================================
     CUSTOM STYLES — scoped to #tpl-aurora
     ============================================================ --}}
<style>
@import url('https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700&display=swap');

/* ── Base ─────────────────────────────────────────────────── */
#tpl-aurora {
    font-family: Inter, 'ui-sans-serif', system-ui, sans-serif;
    background: #06070f;
    color: #f1f5f9;
    position: relative;
}

#tpl-aurora h1,
#tpl-aurora h2,
#tpl-aurora h3 {
    font-family: 'Space Grotesk', Inter, sans-serif;
}

/* ── Aurora blob layer ────────────────────────────────────── */
#aurora-mesh {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
}
#aurora-mesh::before,
#aurora-mesh::after,
#aurora-mesh .blob-a,
#aurora-mesh .blob-b,
#aurora-mesh .blob-c {
    position: absolute;
    border-radius: 9999px;
    filter: blur(90px);
    opacity: 0.45;
    will-change: transform;
}
#aurora-mesh::before {
    content: '';
    width: 900px; height: 900px;
    top: -200px; left: -200px;
    background: radial-gradient(circle, #3b82f6 0%, #6366f1 50%, transparent 80%);
    animation: aurora-drift-1 18s ease-in-out infinite alternate;
}
#aurora-mesh::after {
    content: '';
    width: 700px; height: 700px;
    bottom: -150px; right: -150px;
    background: radial-gradient(circle, #ec4899 0%, #8b5cf6 50%, transparent 80%);
    animation: aurora-drift-2 15s ease-in-out infinite alternate;
}
#aurora-mesh .blob-a {
    width: 600px; height: 600px;
    top: 30%; left: 40%;
    background: radial-gradient(circle, #22d3ee 0%, #6366f1 60%, transparent 85%);
    animation: aurora-drift-3 20s ease-in-out infinite alternate;
}
#aurora-mesh .blob-b {
    width: 500px; height: 500px;
    top: 60%; left: 10%;
    background: radial-gradient(circle, #8b5cf6 0%, #3b82f6 60%, transparent 85%);
    animation: aurora-drift-4 14s ease-in-out infinite alternate;
}
#aurora-mesh .blob-c {
    width: 400px; height: 400px;
    top: 10%; right: 5%;
    background: radial-gradient(circle, #ec4899 0%, #22d3ee 60%, transparent 85%);
    animation: aurora-drift-5 17s ease-in-out infinite alternate;
}

@keyframes aurora-drift-1 {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(120px, 80px) scale(1.15); }
}
@keyframes aurora-drift-2 {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-100px, -60px) scale(1.2); }
}
@keyframes aurora-drift-3 {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-80px, 100px) scale(1.1); }
}
@keyframes aurora-drift-4 {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(90px, -70px) scale(1.15); }
}
@keyframes aurora-drift-5 {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-60px, 80px) scale(1.08); }
}

/* ── Grain overlay ────────────────────────────────────────── */
#aurora-grain {
    position: fixed;
    inset: 0;
    z-index: 1;
    pointer-events: none;
    opacity: 0.035;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 200px 200px;
}

/* ── Reduced motion ───────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
    #aurora-mesh::before,
    #aurora-mesh::after,
    #aurora-mesh .blob-a,
    #aurora-mesh .blob-b,
    #aurora-mesh .blob-c {
        animation: none !important;
    }
}

/* ── Stacking context for content above mesh ──────────────── */
#tpl-aurora > * {
    position: relative;
    z-index: 2;
}

/* ── Glass surface ────────────────────────────────────────── */
.glass {
    background: rgba(255,255,255,0.055);
    border: 1px solid rgba(255,255,255,0.10);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}

/* ── Gradient headline text ───────────────────────────────── */
.text-aurora {
    background: linear-gradient(135deg, #60a5fa 0%, #818cf8 35%, #c084fc 60%, #f472b6 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: transparent;
}

/* ── Neon glow on CTA ─────────────────────────────────────── */
.btn-glow {
    box-shadow: 0 0 20px 4px rgba(99,102,241,0.55), 0 4px 24px rgba(59,130,246,0.4);
    transition: box-shadow 0.2s ease;
}
.btn-glow:hover {
    box-shadow: 0 0 32px 8px rgba(99,102,241,0.75), 0 6px 32px rgba(59,130,246,0.6);
}

/* ── Feature card glow ────────────────────────────────────── */
.card-glow {
    transition: box-shadow 0.25s ease, transform 0.25s ease;
}
.card-glow:hover {
    transform: translateY(-2px);
}

/* ── Pricing highlight glow ───────────────────────────────── */
.pricing-glow {
    box-shadow:
        0 0 0 1px rgba(99,102,241,0.6),
        0 0 40px 6px rgba(99,102,241,0.3),
        0 8px 32px rgba(59,130,246,0.2);
}

/* ── Section backgrounds ──────────────────────────────────── */
.section-dark { background: rgba(10,11,24,0.8); }
.section-darker { background: rgba(6,7,15,0.92); }

/* ── Nav glassmorphism ────────────────────────────────────── */
.nav-glass {
    background: rgba(6,7,15,0.72);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* ── Chart dark overrides ─────────────────────────────────── */
#tpl-aurora .apexcharts-canvas { background: transparent !important; }
#tpl-aurora .apexcharts-grid-borders line,
#tpl-aurora .apexcharts-gridline { stroke: rgba(255,255,255,0.07) !important; }
#tpl-aurora .apexcharts-text { fill: #94a3b8 !important; }

/* ── Kbd in dark context ──────────────────────────────────── */
#tpl-aurora kbd[data-slot="kbd"] {
    background: rgba(255,255,255,0.10);
    color: #cbd5e1;
    border-color: rgba(255,255,255,0.18);
}

/* ── Scrollbar (optional polish) ─────────────────────────── */
#tpl-aurora ::-webkit-scrollbar { width: 6px; }
#tpl-aurora ::-webkit-scrollbar-track { background: transparent; }
#tpl-aurora ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 3px; }
</style>

<div id="tpl-aurora">
    {{-- Aurora mesh + grain --}}
    <div id="aurora-mesh" aria-hidden="true">
        <div class="blob-a"></div>
        <div class="blob-b"></div>
        <div class="blob-c"></div>
    </div>
    <div id="aurora-grain" aria-hidden="true"></div>

    {{-- ── ANNOUNCEMENT BANNER ─────────────────────────────────── --}}
    <div class="relative z-50">
        <x-ui.banner tone="primary" id="lumina-launch" persist>
            <span class="inline-flex items-center gap-2">
                <x-lucide-sparkles class="size-4" />
                <span>Lumina 3.0 is live — AI Copilot + Smart Workflows now in Early Access.</span>
            </span>
            <a href="#pricing" class="font-semibold underline underline-offset-2 opacity-90 hover:opacity-100">See what's new →</a>
        </x-ui.banner>
    </div>

    {{-- ── STICKY NAV ──────────────────────────────────────────── --}}
    <header class="nav-glass sticky top-0 z-40">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
            {{-- Wordmark --}}
            <a href="#" class="flex items-center gap-2.5 font-semibold tracking-tight" style="color:#f1f5f9;">
                <span class="flex size-8 items-center justify-center rounded-lg" style="background:linear-gradient(135deg,#3b82f6,#8b5cf6);">
                    <x-lucide-zap class="size-4 text-white" />
                </span>
                <span class="text-aurora text-base font-bold">Lumina</span>
            </a>

            {{-- Desktop nav links --}}
            <nav class="ml-6 hidden items-center gap-0.5 text-sm md:flex">
                @foreach ($nav as $label => $href)
                    <a href="{{ $href }}"
                       class="rounded-md px-3 py-1.5 font-medium transition-colors"
                       style="color:rgba(203,213,225,0.85);"
                       onmouseover="this.style.color='#f1f5f9';this.style.background='rgba(255,255,255,0.06)'"
                       onmouseout="this.style.color='rgba(203,213,225,0.85)';this.style.background='transparent'">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                {{-- ⌘K hint --}}
                <x-ui.command-dialog>
                    <x-slot:trigger>
                        <button type="button"
                            class="glass hidden items-center gap-1.5 rounded-md px-3 py-1.5 text-xs transition-all hover:bg-white/10 sm:inline-flex"
                            style="color:#94a3b8;">
                            Search
                            <x-ui.kbd-group>
                                <x-ui.kbd>⌘</x-ui.kbd>
                                <x-ui.kbd>K</x-ui.kbd>
                            </x-ui.kbd-group>
                        </button>
                    </x-slot:trigger>
                    <x-ui.command>
                        <x-ui.command-input placeholder="Search Lumina..." />
                        <x-ui.command-list>
                            <x-ui.command-empty>No results found.</x-ui.command-empty>
                            <x-ui.command-group heading="Quick actions">
                                <x-ui.command-item><x-lucide-file-plus class="size-4" /><span>New document</span><x-ui.command-shortcut>⌘N</x-ui.command-shortcut></x-ui.command-item>
                                <x-ui.command-item><x-lucide-brain-circuit class="size-4" /><span>Ask AI copilot</span><x-ui.command-shortcut>⌘I</x-ui.command-shortcut></x-ui.command-item>
                                <x-ui.command-item><x-lucide-workflow class="size-4" /><span>New workflow</span><x-ui.command-shortcut>⌘W</x-ui.command-shortcut></x-ui.command-item>
                            </x-ui.command-group>
                            <x-ui.command-separator />
                            <x-ui.command-group heading="Navigation">
                                <x-ui.command-item><x-lucide-layout-dashboard class="size-4" /><span>Dashboard</span></x-ui.command-item>
                                <x-ui.command-item><x-lucide-users class="size-4" /><span>Team settings</span><x-ui.command-shortcut>⌘T</x-ui.command-shortcut></x-ui.command-item>
                                <x-ui.command-item><x-lucide-settings class="size-4" /><span>Preferences</span><x-ui.command-shortcut>⌘,</x-ui.command-shortcut></x-ui.command-item>
                            </x-ui.command-group>
                        </x-ui.command-list>
                    </x-ui.command>
                </x-ui.command-dialog>

                <a href="#" class="hidden rounded-md px-3 py-1.5 text-sm font-medium transition-colors sm:block"
                   style="color:#94a3b8;"
                   onmouseover="this.style.color='#f1f5f9'" onmouseout="this.style.color='#94a3b8'">
                    Sign in
                </a>
                <a href="#pricing"
                   class="btn-glow inline-flex items-center gap-1.5 rounded-md px-4 py-2 text-sm font-semibold text-white transition-all"
                   style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                    Get started free
                    <x-lucide-arrow-right class="size-3.5" />
                </a>

                {{-- Mobile sheet --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="md:hidden">
                        <button type="button"
                            class="glass inline-flex size-9 items-center justify-center rounded-md"
                            style="color:#cbd5e1;" aria-label="Open menu">
                            <x-lucide-menu class="size-4" />
                        </button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="right" class="!bg-[#0a0b18] !border-white/10">
                        <x-ui.sheet-header>
                            <x-ui.sheet-title class="text-aurora">Lumina</x-ui.sheet-title>
                        </x-ui.sheet-header>
                        <nav class="grid gap-1 px-4 text-sm">
                            @foreach ($nav as $label => $href)
                                <a href="{{ $href }}" @click="open = false"
                                   class="rounded-md px-3 py-2 font-medium"
                                   style="color:#cbd5e1;">{{ $label }}</a>
                            @endforeach
                        </nav>
                        <x-ui.sheet-footer>
                            <a href="#pricing"
                               class="btn-glow flex w-full items-center justify-center gap-1.5 rounded-md py-2 text-sm font-semibold text-white"
                               style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                                Get started free
                            </a>
                            <a href="#" class="mt-2 block w-full rounded-md py-2 text-center text-sm font-medium"
                               style="color:#94a3b8; border:1px solid rgba(255,255,255,0.12);">Sign in</a>
                        </x-ui.sheet-footer>
                    </x-ui.sheet-content>
                </x-ui.sheet>
            </div>
        </div>
    </header>

    {{-- ── HERO ─────────────────────────────────────────────────── --}}
    <section class="relative overflow-hidden px-6 pb-24 pt-20 lg:pt-32">
        <div class="mx-auto max-w-5xl text-center">
            {{-- Badge --}}
            <div class="mb-6 inline-flex">
                <span class="glass inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium"
                      style="color:#a5b4fc; border-color:rgba(99,102,241,0.35);">
                    <x-lucide-sparkles class="size-3.5" style="color:#818cf8;" />
                    Now with AI Copilot — Early Access open
                    <x-ui.badge tone="info" variant="soft" size="sm">New</x-ui.badge>
                </span>
            </div>

            {{-- Headline --}}
            <h1 class="mx-auto mb-6 max-w-4xl text-5xl font-bold leading-[1.08] tracking-tight text-balance lg:text-7xl">
                The AI workspace that helps you&nbsp;
                <span class="text-aurora">
                    <x-ui.typewriter
                        :words="['think faster', 'write better', 'ship more', 'stay focused']"
                        :typeSpeed="75"
                        :deleteSpeed="35"
                        :pause="2000"
                    />
                </span>
            </h1>

            {{-- Subhead --}}
            <p class="mx-auto mb-10 max-w-2xl text-lg text-balance lg:text-xl" style="color:#94a3b8;">
                Lumina is the AI-native workspace where teams write, analyse and automate — all in one place, with an assistant that actually understands your work.
            </p>

            {{-- CTAs --}}
            <div class="mb-10 flex flex-wrap items-center justify-center gap-4">
                <a href="#pricing"
                   class="btn-glow inline-flex items-center gap-2 rounded-xl px-7 py-3.5 text-base font-semibold text-white"
                   style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                    <x-lucide-zap class="size-4" />
                    Start free — no card needed
                </a>
                <a href="#features"
                   class="glass inline-flex items-center gap-2 rounded-xl px-7 py-3.5 text-base font-semibold transition-all hover:bg-white/10"
                   style="color:#e2e8f0;">
                    <x-lucide-play class="size-4" />
                    See how it works
                </a>
            </div>

            {{-- Trusted avatars + stars --}}
            <div class="flex flex-wrap items-center justify-center gap-5">
                <div class="flex -space-x-2.5">
                    @foreach (['aurora1','aurora2','aurora3','aurora4','aurora5'] as $seed)
                        <x-ui.avatar class="ring-[#0a0b18] size-9 ring-2">
                            <x-ui.avatar-image src="https://picsum.photos/seed/{{ $seed }}/80/80" alt="Lumina user" />
                            <x-ui.avatar-fallback style="background:rgba(99,102,241,0.3);color:#a5b4fc;">U</x-ui.avatar-fallback>
                        </x-ui.avatar>
                    @endforeach
                </div>
                <div class="text-left text-sm">
                    <div class="flex gap-0.5" style="color:#f59e0b;">
                        @for ($i = 0; $i < 5; $i++) <x-lucide-star class="size-4 fill-current" /> @endfor
                    </div>
                    <span style="color:#64748b;">Trusted by <strong style="color:#f1f5f9;">42,000+</strong> teams worldwide</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ── LOGO MARQUEE ──────────────────────────────────────────── --}}
    <div class="section-dark border-y py-10" style="border-color:rgba(255,255,255,0.07);">
        <p class="mb-5 text-center text-xs font-medium uppercase tracking-widest" style="color:#475569;">
            Integrated with the tools your team already uses
        </p>
        <x-ui.marquee :duration="'30s'" fade class="mx-auto max-w-5xl">
            @foreach ($logos as $name)
                <span class="px-6 text-lg font-bold whitespace-nowrap" style="color:rgba(148,163,184,0.5);">{{ $name }}</span>
            @endforeach
        </x-ui.marquee>
    </div>

    {{-- ── STATS STRIP ──────────────────────────────────────────── --}}
    <div class="section-darker border-b py-16" style="border-color:rgba(255,255,255,0.07);">
        <div class="mx-auto grid max-w-5xl grid-cols-2 gap-10 px-6 text-center lg:grid-cols-4">
            @foreach ($stats as $s)
                <div>
                    <div class="text-aurora text-4xl font-bold tracking-tight">{{ $s['v'] }}</div>
                    <div class="mt-1 text-sm" style="color:#64748b;">{{ $s['l'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ── BENTO FEATURE GRID ───────────────────────────────────── --}}
    <section id="features" class="scroll-mt-20 px-6 py-20 lg:py-28">
        <div class="mx-auto max-w-6xl">
            <div class="mb-14 text-center">
                <x-ui.badge variant="outline" class="mb-4" style="border-color:rgba(99,102,241,0.5);color:#a5b4fc;background:rgba(99,102,241,0.08);">Features</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color:#f1f5f9;">
                    Everything your team needs to do<br class="hidden sm:block"> its best work
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-lg text-balance" style="color:#64748b;">
                    One AI-native workspace. No context switching, no tab soup — just your work, smarter.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as $idx => $f)
                    <div class="glass card-glow group rounded-2xl p-7"
                         style="box-shadow: 0 0 0 0 {{ $f['glow'] }}22; transition:box-shadow 0.3s ease,transform 0.25s ease;"
                         onmouseover="this.style.boxShadow='0 0 28px 4px {{ $f['glow'] }}33, 0 4px 20px rgba(0,0,0,0.4)'"
                         onmouseout="this.style.boxShadow='0 0 0 0 {{ $f['glow'] }}22'">
                        <div class="mb-5 inline-flex size-12 items-center justify-center rounded-xl"
                             style="background:linear-gradient(135deg,{{ $f['glow'] }}22,{{ $f['glow'] }}44); box-shadow:0 0 16px 2px {{ $f['glow'] }}44;">
                            <x-dynamic-component :component="'lucide-'.$f['icon']" class="size-5" style="color:{{ $f['glow'] }};" />
                        </div>
                        <h3 class="mb-2 font-semibold" style="color:#f1f5f9;">{{ $f['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color:#64748b;">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── ANALYTICS SHOWCASE (Chart) ─────────────────────────── --}}
    <section id="integrations" class="section-dark scroll-mt-20 border-y px-6 py-20 lg:py-28"
             style="border-color:rgba(255,255,255,0.07);">
        <div class="mx-auto max-w-6xl">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                {{-- Copy --}}
                <div>
                    <x-ui.badge variant="outline" class="mb-5" style="border-color:rgba(34,211,238,0.45);color:#67e8f9;background:rgba(34,211,238,0.08);">Live Analytics</x-ui.badge>
                    <h2 class="mb-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color:#f1f5f9;">
                        Intelligence that updates<br>as your team works
                    </h2>
                    <p class="mb-6 text-base leading-relaxed" style="color:#64748b;">
                        Lumina tracks every action, commit and conversation. The result: a living map of how your team's output evolves — surfaced in beautiful, interactive charts the moment the data changes.
                    </p>
                    <ul class="space-y-3">
                        @foreach (['AI-generated insight summaries', 'Drill-down to individual contributors', 'Scheduled email digests', 'Export to CSV or embed anywhere'] as $p)
                            <li class="flex items-center gap-2.5 text-sm" style="color:#cbd5e1;">
                                <span class="inline-flex size-5 shrink-0 items-center justify-center rounded-full"
                                      style="background:rgba(34,211,238,0.15);">
                                    <x-lucide-check class="size-3" style="color:#22d3ee;" />
                                </span>
                                {{ $p }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-7 flex gap-3">
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <a href="#pricing"
                                   class="btn-glow inline-flex items-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold text-white"
                                   style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                                    Explore analytics
                                    <x-lucide-arrow-right class="size-4" />
                                </a>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content>Live data — no demo fixtures</x-ui.tooltip-content>
                        </x-ui.tooltip>
                    </div>
                </div>

                {{-- Chart card --}}
                <div class="glass rounded-2xl p-6" style="box-shadow:0 0 40px 6px rgba(34,211,238,0.12);">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-widest" style="color:#475569;">Team output — last 8 weeks</p>
                            <p class="mt-0.5 text-2xl font-bold" style="color:#f1f5f9;">+34.2%</p>
                        </div>
                        <x-ui.badge tone="success" variant="soft">
                            <x-lucide-trending-up class="size-3" />
                            Live
                        </x-ui.badge>
                    </div>
                    <x-ui.chart
                        type="area"
                        label="Team output chart"
                        :series="[
                            ['name' => 'Documents', 'data' => [42, 58, 55, 71, 68, 89, 94, 112]],
                            ['name' => 'Workflows', 'data' => [18, 22, 27, 31, 38, 45, 52, 61]],
                        ]"
                        :colors="['#22d3ee', '#8b5cf6']"
                        :options="[
                            'xaxis' => ['categories' => ['Wk 1', 'Wk 2', 'Wk 3', 'Wk 4', 'Wk 5', 'Wk 6', 'Wk 7', 'Wk 8'], 'labels' => ['style' => ['colors' => '#475569']]],
                            'yaxis' => ['labels' => ['style' => ['colors' => '#475569']]],
                            'fill' => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 0, 'opacityFrom' => 0.3, 'opacityTo' => 0.02, 'stops' => [0, 100]]],
                            'stroke' => ['width' => 2, 'curve' => 'smooth'],
                            'legend' => ['labels' => ['colors' => '#94a3b8']],
                            'tooltip' => ['theme' => 'dark'],
                            'chart' => ['background' => 'transparent'],
                        ]"
                        class="aspect-auto h-[220px]"
                    />
                </div>
            </div>
        </div>
    </section>

    {{-- ── PRODUCT TABS (Spotlight) ─────────────────────────────── --}}
    <section class="section-darker px-6 py-20 lg:py-28">
        <div class="mx-auto max-w-6xl">
            <div class="mb-12 text-center">
                <x-ui.badge variant="outline" class="mb-4" style="border-color:rgba(139,92,246,0.5);color:#c084fc;background:rgba(139,92,246,0.08);">How it works</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color:#f1f5f9;">A closer look inside Lumina</h2>
            </div>
            <x-ui.tabs value="write" class="mx-auto w-full max-w-5xl">
                <div class="flex justify-center">
                    <x-ui.tabs-list variant="segmented" class="mb-8" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.10);">
                        @foreach ($spotlight as $key => $s)
                            <x-ui.tabs-trigger value="{{ $key }}" style="color:#94a3b8;">{{ $s['label'] }}</x-ui.tabs-trigger>
                        @endforeach
                    </x-ui.tabs-list>
                </div>
                @foreach ($spotlight as $key => $s)
                    <x-ui.tabs-content value="{{ $key }}">
                        <div class="grid items-center gap-10 lg:grid-cols-2">
                            <div>
                                <div class="mb-4 inline-flex size-12 items-center justify-center rounded-xl"
                                     style="background:linear-gradient(135deg,rgba(99,102,241,0.2),rgba(139,92,246,0.3));">
                                    <x-dynamic-component :component="'lucide-'.$s['icon']" class="size-5" style="color:#a5b4fc;" />
                                </div>
                                <h3 class="mb-3 text-2xl font-semibold tracking-tight" style="color:#f1f5f9;">{{ $s['title'] }}</h3>
                                <p class="mb-5 leading-relaxed" style="color:#64748b;">{{ $s['desc'] }}</p>
                                <ul class="space-y-2.5 text-sm">
                                    @foreach ($s['points'] as $p)
                                        <li class="flex items-center gap-2.5" style="color:#cbd5e1;">
                                            <span class="inline-flex size-5 shrink-0 items-center justify-center rounded-full"
                                                  style="background:rgba(99,102,241,0.18);">
                                                <x-lucide-check class="size-3" style="color:#818cf8;" />
                                            </span>
                                            {{ $p }}
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="#pricing"
                                   class="mt-6 inline-flex items-center gap-1.5 text-sm font-medium"
                                   style="color:#818cf8;"
                                   onmouseover="this.style.color='#a5b4fc'" onmouseout="this.style.color='#818cf8'">
                                    Learn more <x-lucide-arrow-right class="size-4" />
                                </a>
                            </div>
                            <div class="glass overflow-hidden rounded-2xl" style="box-shadow:0 0 30px 4px rgba(99,102,241,0.15);">
                                <img src="https://picsum.photos/seed/lumina-{{ $key }}/720/480"
                                     alt="{{ $s['title'] }}"
                                     loading="lazy"
                                     class="size-full object-cover opacity-80"
                                     width="720" height="480" />
                            </div>
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    {{-- ── TESTIMONIALS CAROUSEL ────────────────────────────────── --}}
    <section class="section-dark border-y px-6 py-20 lg:py-28" style="border-color:rgba(255,255,255,0.07);">
        <div class="mx-auto max-w-6xl">
            <div class="mb-12 text-center">
                <x-ui.badge variant="outline" class="mb-4" style="border-color:rgba(236,72,153,0.45);color:#f9a8d4;background:rgba(236,72,153,0.08);">Testimonials</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color:#f1f5f9;">
                    Teams doing their best work with Lumina
                </h2>
            </div>

            <x-ui.carousel class="mx-auto max-w-3xl">
                <x-ui.carousel-content>
                    @foreach ($testimonials as $t)
                        <x-ui.carousel-item>
                            <div class="glass rounded-2xl p-8 lg:p-10" style="box-shadow:0 0 24px 2px rgba(236,72,153,0.08);">
                                <div class="mb-6 flex gap-0.5" style="color:#f59e0b;">
                                    @for ($i = 0; $i < 5; $i++) <x-lucide-star class="size-4 fill-current" /> @endfor
                                </div>
                                <blockquote class="mb-8 text-lg leading-relaxed text-balance" style="color:#e2e8f0;">
                                    "{{ $t['q'] }}"
                                </blockquote>
                                <div class="flex items-center gap-3">
                                    <x-ui.avatar class="size-11">
                                        <x-ui.avatar-image src="https://picsum.photos/seed/{{ $t['seed'] }}/88/88" alt="{{ $t['a'] }}" />
                                        <x-ui.avatar-fallback style="background:rgba(99,102,241,0.3);color:#a5b4fc;">
                                            {{ substr($t['a'], 0, 1) }}
                                        </x-ui.avatar-fallback>
                                    </x-ui.avatar>
                                    <div>
                                        <div class="text-sm font-semibold" style="color:#f1f5f9;">{{ $t['a'] }}</div>
                                        <div class="text-xs" style="color:#64748b;">{{ $t['r'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <div class="mt-6 flex items-center justify-center gap-3">
                    <x-ui.carousel-previous class="static translate-y-0 !bg-white/8 !border-white/12 !text-slate-300 hover:!bg-white/15 hover:!text-white" />
                    <x-ui.carousel-next class="static translate-y-0 !bg-white/8 !border-white/12 !text-slate-300 hover:!bg-white/15 hover:!text-white" />
                </div>
            </x-ui.carousel>
        </div>
    </section>

    {{-- ── PRICING ──────────────────────────────────────────────── --}}
    <section id="pricing" class="section-darker scroll-mt-20 px-6 py-20 lg:py-28" x-data="{ yearly: false }">
        <div class="mx-auto max-w-6xl">
            <div class="mb-12 text-center">
                <x-ui.badge variant="outline" class="mb-4" style="border-color:rgba(59,130,246,0.45);color:#93c5fd;background:rgba(59,130,246,0.08);">Pricing</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color:#f1f5f9;">Simple pricing, serious value</h2>
                <p class="mt-3 text-lg" style="color:#64748b;">Start free. Add your team whenever you're ready.</p>

                {{-- Billing toggle --}}
                <div class="mt-7 inline-flex items-center gap-3 rounded-xl px-5 py-3 text-sm"
                     style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.10);">
                    <span :class="!yearly ? 'font-semibold' : 'opacity-60'" style="color:#f1f5f9;">Monthly</span>
                    <x-ui.switch x-on:click="yearly = !yearly" :checked="false" />
                    <span :class="yearly ? 'font-semibold' : 'opacity-60'" style="color:#f1f5f9;">
                        Annual
                        <x-ui.badge tone="success" variant="soft" class="ml-1.5 text-[10px]">Save 20%</x-ui.badge>
                    </span>
                </div>
            </div>

            <div class="grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div @class(['glass rounded-2xl p-8 flex flex-col relative', 'pricing-glow' => $plan['highlight']])>
                        @if ($plan['highlight'])
                            <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 rounded-full px-4 py-1 text-xs font-semibold text-white whitespace-nowrap"
                                  style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                                Most popular
                            </span>
                        @endif

                        <div class="mb-1 text-base font-semibold" style="color:#f1f5f9;">{{ $plan['name'] }}</div>
                        <div class="mb-5 text-sm" style="color:#64748b;">{{ $plan['tag'] }}</div>

                        <div class="mb-6 flex items-baseline gap-1">
                            <span class="text-4xl font-bold tracking-tight" style="color:#f1f5f9;">
                                $<span x-text="yearly ? {{ $plan['y'] }} : {{ $plan['m'] }}">{{ $plan['m'] }}</span>
                            </span>
                            <span class="text-sm" style="color:#64748b;">/mo</span>
                            <span x-show="yearly && {{ $plan['y'] }} < {{ $plan['m'] }}" x-cloak class="ml-1 text-xs line-through" style="color:#475569;">${{ $plan['m'] }}</span>
                        </div>

                        <a href="#"
                           class="@if($plan['highlight']) btn-glow text-white @endif mb-6 flex w-full items-center justify-center rounded-xl py-2.5 text-sm font-semibold transition-all"
                           style="{{ $plan['highlight'] ? 'background:linear-gradient(135deg,#4f46e5,#7c3aed);' : 'background:rgba(255,255,255,0.06);color:#e2e8f0;border:1px solid rgba(255,255,255,0.12);' }}">
                            {{ $plan['cta'] }}
                        </a>

                        <x-ui.separator class="mb-6" style="background:rgba(255,255,255,0.08);" />

                        <ul class="mt-auto space-y-3.5 text-sm">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-start gap-2.5" style="color:#cbd5e1;">
                                    <x-lucide-check class="mt-0.5 size-4 shrink-0" style="color:#818cf8;" />
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <p class="mt-8 text-center text-sm" style="color:#475569;">
                All plans include a 14-day free trial. No credit card required.
                <a href="#" class="ml-1 underline underline-offset-2" style="color:#818cf8;">Compare plans →</a>
            </p>
        </div>
    </section>

    {{-- ── COMMAND PALETTE TEASER ───────────────────────────────── --}}
    <section class="section-dark border-y px-6 py-16 lg:py-20" style="border-color:rgba(255,255,255,0.07);">
        <div class="mx-auto max-w-4xl text-center">
            <p class="mb-3 text-sm font-medium uppercase tracking-widest" style="color:#475569;">Built for keyboard-first teams</p>
            <h2 class="mb-4 text-2xl font-bold tracking-tight sm:text-3xl" style="color:#f1f5f9;">
                Everything in two keystrokes
            </h2>
            <p class="mx-auto mb-10 max-w-xl" style="color:#64748b;">
                Press
                <x-ui.kbd-group class="mx-1 inline-flex">
                    <x-ui.kbd>⌘</x-ui.kbd>
                    <x-ui.kbd>K</x-ui.kbd>
                </x-ui.kbd-group>
                anywhere in Lumina to open the command palette. Create docs, trigger workflows, jump to teammates' work — without reaching for the mouse.
            </p>

            {{-- Static command palette preview --}}
            <div class="glass mx-auto max-w-lg overflow-hidden rounded-2xl text-left"
                 style="box-shadow:0 0 60px 8px rgba(99,102,241,0.2);">
                <x-ui.command>
                    <x-ui.command-input placeholder="Ask Lumina anything..." />
                    <x-ui.command-list>
                        <x-ui.command-empty>No results found.</x-ui.command-empty>
                        <x-ui.command-group heading="AI actions">
                            <x-ui.command-item>
                                <x-lucide-brain-circuit class="size-4" style="color:#818cf8;" />
                                <span>Summarise this document</span>
                                <x-ui.command-shortcut>⌘I</x-ui.command-shortcut>
                            </x-ui.command-item>
                            <x-ui.command-item>
                                <x-lucide-wand-sparkles class="size-4" style="color:#f472b6;" />
                                <span>Improve writing</span>
                                <x-ui.command-shortcut>⌘E</x-ui.command-shortcut>
                            </x-ui.command-item>
                            <x-ui.command-item>
                                <x-lucide-languages class="size-4" style="color:#22d3ee;" />
                                <span>Translate to French</span>
                            </x-ui.command-item>
                        </x-ui.command-group>
                        <x-ui.command-separator />
                        <x-ui.command-group heading="Quick navigation">
                            <x-ui.command-item>
                                <x-lucide-file-text class="size-4" />
                                <span>New document</span>
                                <x-ui.command-shortcut>⌘N</x-ui.command-shortcut>
                            </x-ui.command-item>
                            <x-ui.command-item>
                                <x-lucide-workflow class="size-4" />
                                <span>New workflow</span>
                                <x-ui.command-shortcut>⌘W</x-ui.command-shortcut>
                            </x-ui.command-item>
                            <x-ui.command-item>
                                <x-lucide-users class="size-4" />
                                <span>Invite teammate</span>
                            </x-ui.command-item>
                        </x-ui.command-group>
                    </x-ui.command-list>
                </x-ui.command>
            </div>
        </div>
    </section>

    {{-- ── FAQ ─────────────────────────────────────────────────── --}}
    <section id="faq" class="section-darker scroll-mt-20 px-6 py-20 lg:py-28">
        <div class="mx-auto max-w-3xl">
            <div class="mb-12 text-center">
                <x-ui.badge variant="outline" class="mb-4" style="border-color:rgba(99,102,241,0.45);color:#a5b4fc;background:rgba(99,102,241,0.08);">FAQ</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color:#f1f5f9;">Questions we get a lot</h2>
            </div>
            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}"
                        class="!border-white/10">
                        <x-ui.accordion-trigger class="!text-slate-200 hover:!text-white">{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content class="!text-slate-400">{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    {{-- ── BIG CLOSING CTA ──────────────────────────────────────── --}}
    <section class="section-dark border-y px-6 py-20 lg:py-28" style="border-color:rgba(255,255,255,0.07);">
        <div class="mx-auto max-w-4xl">
            <div class="glass relative overflow-hidden rounded-3xl px-10 py-16 text-center lg:px-20 lg:py-24"
                 style="box-shadow:0 0 80px 12px rgba(99,102,241,0.2);">
                {{-- Background glow orbs for the CTA card --}}
                <div class="pointer-events-none absolute -left-16 -top-16 size-64 rounded-full blur-3xl"
                     style="background:rgba(99,102,241,0.25);" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-16 -right-16 size-64 rounded-full blur-3xl"
                     style="background:rgba(236,72,153,0.2);" aria-hidden="true"></div>

                <div class="relative">
                    <x-ui.badge variant="outline" class="mb-6" style="border-color:rgba(99,102,241,0.5);color:#a5b4fc;background:rgba(99,102,241,0.1);">
                        <x-lucide-zap class="size-3" />
                        Free 14-day trial · No credit card
                    </x-ui.badge>
                    <h2 class="mb-4 text-3xl font-bold tracking-tight text-balance sm:text-5xl" style="color:#f1f5f9;">
                        Start building your <span class="text-aurora">AI workspace</span> today
                    </h2>
                    <p class="mx-auto mb-10 max-w-xl text-lg text-balance" style="color:#64748b;">
                        Join 42,000+ teams already using Lumina to write faster, decide smarter, and ship more.
                    </p>

                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="#pricing"
                           class="btn-glow inline-flex items-center gap-2 rounded-xl px-8 py-4 text-base font-semibold text-white"
                           style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                            <x-lucide-zap class="size-4" />
                            Start for free
                        </a>
                        <a href="#"
                           class="glass inline-flex items-center gap-2 rounded-xl px-8 py-4 text-base font-semibold transition-all hover:bg-white/10"
                           style="color:#e2e8f0;">
                            <x-lucide-calendar class="size-4" />
                            Book a demo
                        </a>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-sm" style="color:#475569;">
                        @foreach (['SOC 2 Type II', 'GDPR ready', 'SAML SSO', '99.99% uptime'] as $badge)
                            <span class="flex items-center gap-1.5">
                                <x-lucide-shield-check class="size-4" style="color:#22d3ee;" />
                                {{ $badge }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── FOOTER ───────────────────────────────────────────────── --}}
    <footer class="section-darker border-t px-6 pt-16 pb-10" style="border-color:rgba(255,255,255,0.07);">
        <div class="mx-auto max-w-6xl">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                {{-- Brand col --}}
                <div class="lg:col-span-2">
                    <a href="#" class="mb-4 flex items-center gap-2.5 font-semibold">
                        <span class="flex size-8 items-center justify-center rounded-lg"
                              style="background:linear-gradient(135deg,#3b82f6,#8b5cf6);">
                            <x-lucide-zap class="size-4 text-white" />
                        </span>
                        <span class="text-aurora font-bold">Lumina</span>
                    </a>
                    <p class="mb-6 max-w-xs text-sm leading-relaxed" style="color:#475569;">
                        The AI-native workspace for teams that want to write faster, decide smarter, and ship more.
                    </p>
                    <div class="flex gap-2">
                        @foreach (['github', 'twitter', 'linkedin', 'youtube'] as $s)
                            <x-ui.tooltip>
                                <x-ui.tooltip-trigger>
                                    <a href="#" aria-label="{{ ucfirst($s) }}"
                                       class="glass inline-flex size-9 items-center justify-center rounded-lg transition-all hover:bg-white/10"
                                       style="color:#64748b;">
                                        <x-dynamic-component :component="'lucide-'.$s" class="size-4" />
                                    </a>
                                </x-ui.tooltip-trigger>
                                <x-ui.tooltip-content>{{ ucfirst($s) }}</x-ui.tooltip-content>
                            </x-ui.tooltip>
                        @endforeach
                    </div>
                </div>

                {{-- Link cols --}}
                @foreach ($footer as $heading => $links)
                    <div>
                        <h3 class="mb-4 text-xs font-semibold uppercase tracking-widest" style="color:#94a3b8;">{{ $heading }}</h3>
                        <ul class="space-y-2.5 text-sm">
                            @foreach ($links as $link)
                                <li>
                                    <a href="#"
                                       class="transition-colors"
                                       style="color:#475569;"
                                       onmouseover="this.style.color='#cbd5e1'" onmouseout="this.style.color='#475569'">
                                        {{ $link }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-10" style="background:rgba(255,255,255,0.07);" />

            <div class="flex flex-col items-center justify-between gap-3 text-xs sm:flex-row" style="color:#334155;">
                <span>© {{ date('Y') }} Lumina, Inc. All rights reserved.</span>
                <span class="flex items-center gap-4">
                    <span class="flex items-center gap-1.5">
                        <x-lucide-shield-check class="size-3.5" style="color:#22d3ee;" />
                        SOC 2 Type II · GDPR ready
                    </span>
                    <span>Made with ☁ in San Francisco</span>
                </span>
            </div>
        </div>
    </footer>

</div>{{-- #tpl-aurora --}}

</x-layouts.app>
