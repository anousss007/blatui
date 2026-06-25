@php
    // Live counts — derived from the real sources so the marketing numbers never drift.
    $countNonIndex = fn ($glob) => collect(glob(resource_path($glob)) ?: [])->reject(fn ($p) => basename($p) === 'index.blade.php')->count();
    $componentCount = collect(config('docs.categories'))->flatten()->count();
    $variantCount = count(glob(resource_path('views/examples/*/*.blade.php')) ?: []);
    $blockCount = $countNonIndex('views/blocks/*.blade.php');
    $chartCount = $countNonIndex('views/charts/*.blade.php');
    $templateCount = $countNonIndex('views/templates/*.blade.php');
    preg_match('/##\s*\[([0-9][0-9.]*)\]/', @file_get_contents(base_path('CHANGELOG.md')) ?: '', $vm);
    $version = $vm[1] ?? '';

    $features = [
        ['icon' => 'accessibility', 'title' => 'Accessible by default', 'desc' => 'WAI-ARIA roles, full keyboard navigation, focus management and WCAG AA contrast — every component audited with axe-core.'],
        ['icon' => 'copy', 'title' => 'You own the code', 'desc' => 'Components are copied into your project with one Artisan command. No black-box dependency, no runtime.'],
        ['icon' => 'paintbrush', 'title' => 'Themeable to the core', 'desc' => 'Every token is a CSS variable. Recolor, restyle and export your theme in seconds — live.'],
        ['icon' => 'zap', 'title' => 'Zero JS runtime', 'desc' => 'No React, no build-step lock-in. Just Blade and a sprinkle of Alpine you can actually read.'],
        ['icon' => 'moon', 'title' => 'Dark mode built-in', 'desc' => 'Every component ships light + dark, switchable instantly and persisted across visits.'],
        ['icon' => 'bot', 'title' => 'Agent-ready', 'desc' => 'A hosted MCP server, llms.txt and a shadcn-compatible registry so AI tools can install components.'],
    ];

    $explore = [
        ['Components', (string) $componentCount, $variantCount.' variants to copy', '/components', 'component'],
        ['Blocks', (string) $blockCount, 'full-page layouts', '/blocks', 'layout-template'],
        ['Templates', (string) $templateCount, 'art-directed pages', '/templates', 'panels-top-left'],
        ['Charts', (string) $chartCount, 'data visualizations', '/charts', 'chart-column'],
    ];

    $stack = ['Blade', 'Laravel', 'Alpine.js', 'Tailwind CSS', 'Livewire', 'Inertia', 'shadcn registry', 'ApexCharts'];

    // A few flagship Showcase templates to flaunt on the home page.
    $flagships = [
        ['aurora', 'Aurora', 'AI workspace', 'glassmorphism'],
        ['quantum', 'Quantum', 'Web3 dashboard', 'neon'],
        ['forge', 'Forge', 'Developer platform', 'terminal'],
        ['vinyl', 'Vinyl', 'Music festival', 'retro'],
        ['terroir', 'Terroir', 'Fine dining', 'editorial'],
        ['prism', 'Prism', 'NFT market', 'holographic'],
        ['bloom', 'Bloom', 'Wellness app', 'claymorphism'],
        ['brut', 'Brut', 'Creative studio', 'brutalist'],
    ];
@endphp

<x-layouts.app>
    <x-site.header />

    {{-- ═══════════════════════════ HERO ═══════════════════════════ --}}
    <section class="relative overflow-hidden border-b">
        <div class="blat-dotgrid pointer-events-none absolute inset-0 -z-10 opacity-60 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"></div>
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="h-[420px] w-[760px] rounded-full blur-3xl" style="background: radial-gradient(ellipse, color-mix(in srgb, var(--blat-brand) 16%, transparent) 0%, transparent 70%);"></div>
        </div>

        <div class="mx-auto grid max-w-screen-xl items-center gap-12 px-6 py-16 lg:grid-cols-2 lg:gap-10 lg:px-8 lg:py-24">
            {{-- Left --}}
            <div>
                <a href="/components" class="blat-pill mb-5 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-medium">
                    <span class="inline-block size-1.5 animate-pulse rounded-full" style="background: var(--blat-brand);"></span>
                    <span class="blat-mono">v{{ $version }} · {{ $componentCount }} components · {{ $variantCount }} variants</span>
                </a>

                <h1 class="text-4xl font-bold tracking-tight text-balance sm:text-5xl lg:text-6xl" style="line-height: 1.08;">
                    Beautiful Laravel UI.<br>
                    <span class="blat-brand-text">Copy, paste, own it.</span>
                </h1>

                <p class="text-muted-foreground mt-5 max-w-xl text-lg text-pretty">
                    The complete shadcn/ui experience — faithfully ported to Blade, Alpine &amp; Tailwind v4.
                    Accessible by default. No npm runtime, no lock-in. You ship the actual code.
                </p>

                {{-- Install line --}}
                <div class="mt-7">
                    <p class="blat-mono blat-brand-text mb-2 text-[11px] font-medium tracking-[0.14em] uppercase">// install</p>
                    <div class="bg-card flex max-w-md items-center gap-2 rounded-lg border p-1.5 pl-3 shadow-sm"
                         x-data="{ copied: false, copy() { navigator.clipboard.writeText('composer require anousss007/blatui'); this.copied = true; setTimeout(() => this.copied = false, 1500); } }">
                        <span class="blat-mono shrink-0 text-sm" style="color: var(--blat-brand-ink);">$</span>
                        <span class="blat-mono min-w-0 flex-1 truncate text-sm">composer require anousss007/blatui</span>
                        <button type="button" @click="copy()" class="hover:bg-accent text-muted-foreground hover:text-foreground inline-flex size-7 shrink-0 items-center justify-center rounded transition-colors" aria-label="Copy install command">
                            <x-lucide-copy class="size-3.5" x-show="!copied" />
                            <x-lucide-check class="size-3.5" style="color: var(--blat-brand-ink);" x-show="copied" x-cloak />
                        </button>
                    </div>
                </div>

                <div class="mt-7 flex flex-wrap items-center gap-3">
                    <a href="/components" class="blat-glow-btn blat-brand-fill inline-flex h-11 items-center gap-1.5 rounded-md px-5 text-sm font-semibold">
                        Browse components <x-lucide-arrow-right class="size-4" />
                    </a>
                    <a href="/docs" class="bg-card hover:bg-accent inline-flex h-11 items-center gap-1.5 rounded-md border px-5 text-sm font-medium transition-colors">
                        <x-lucide-book-open class="size-4" /> Read the docs
                    </a>
                </div>

                <ul class="text-muted-foreground mt-7 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm" aria-label="Highlights">
                    @foreach (['WAI-ARIA', 'Full keyboard & focus', 'WCAG AA contrast', 'Light + dark'] as $hl)
                        <li class="inline-flex items-center gap-1.5"><x-lucide-circle-check class="size-4" style="color: var(--blat-brand-ink);" aria-hidden="true" /> {{ $hl }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Right: terminal mockup --}}
            <div class="relative">
                <div class="pointer-events-none absolute -inset-6 -z-10 opacity-40" style="background: radial-gradient(ellipse at 60% 40%, color-mix(in srgb, var(--blat-brand) 22%, transparent) 0%, transparent 70%); filter: blur(36px); border-radius: 2rem;"></div>
                <div class="blat-term">
                    <div class="blat-term-bar flex items-center gap-2 px-3.5 py-2.5">
                        <span class="size-3 rounded-full" style="background:#ff5f57;"></span>
                        <span class="size-3 rounded-full" style="background:#febc2e;"></span>
                        <span class="size-3 rounded-full" style="background:#28c840;"></span>
                        <span class="blat-mono ml-3 text-xs" style="color:#7d8590;">~/app — blatui</span>
                    </div>
                    <div class="blat-term-body space-y-1 px-4 py-4 text-[12.5px] leading-relaxed sm:text-[13px]">
                        <div class="blat-term-line"><span style="color: var(--blat-brand);">~/app $</span> <span style="color:#e6edf3;">php artisan blatui:init</span></div>
                        <div class="blat-term-line" style="color:#7d8590;">&nbsp;&nbsp;Foundations published · Tailwind wired · Alpine ready</div>
                        <div class="blat-term-line"><span style="color: var(--blat-brand);">~/app $</span> <span style="color:#e6edf3;">php artisan blatui:add button card dialog</span></div>
                        <div class="blat-term-line"><span style="color: var(--blat-brand);">&nbsp;&nbsp;✓</span> <span style="color:#7d8590;">Published button.blade.php</span></div>
                        <div class="blat-term-line"><span style="color: var(--blat-brand);">&nbsp;&nbsp;✓</span> <span style="color:#7d8590;">Published card.blade.php</span></div>
                        <div class="blat-term-line"><span style="color: var(--blat-brand);">&nbsp;&nbsp;✓</span> <span style="color:#7d8590;">Published dialog.blade.php</span></div>
                        <div class="blat-term-line"><span style="color: var(--blat-brand);">&nbsp;&nbsp;✓</span> <span style="color:#e6edf3;"> 3 components — </span><span style="color:#39c5cf;">you own the code.</span></div>
                        <div class="blat-term-line pt-1"><span style="color: var(--blat-brand);">~/app $</span> <span class="blat-caret" aria-hidden="true"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ WORKS WITH ═══════════════════════════ --}}
    <section class="border-b py-8">
        <p class="blat-mono blat-brand-text mb-5 text-center text-[11px] font-medium tracking-[0.14em] uppercase">// works with your stack</p>
        <x-ui.marquee fade :duration="'34s'" class="mx-auto max-w-5xl">
            @foreach ($stack as $name)
                <span class="blat-mono text-muted-foreground px-6 text-sm font-medium whitespace-nowrap">{{ $name }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ═══════════════════════════ LIVE PREVIEW (reacts to customizer) ═══════════════════════════ --}}
    <section class="border-b">
        <div class="mx-auto max-w-screen-xl px-6 py-16 lg:px-8 lg:py-20">
            <div class="mb-8 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="blat-mono blat-brand-text mb-2 text-[11px] font-medium tracking-[0.14em] uppercase">// live preview</p>
                    <h2 class="text-2xl font-bold tracking-tight sm:text-3xl">Real components, your theme.</h2>
                </div>
                <p class="text-muted-foreground max-w-sm text-sm">
                    Everything below is live. Hit <span class="text-foreground font-medium">Customize</span> in the header — color, radius, font and shadows restyle this canvas instantly.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <x-ui.card variant="sectioned" class="md:col-span-2">
                    <x-ui.card-header>
                        <x-ui.card-description>Total Revenue</x-ui.card-description>
                        <x-ui.card-title class="text-3xl font-semibold tabular-nums">$1,250.00</x-ui.card-title>
                        <x-ui.card-action><x-ui.badge variant="outline"><x-lucide-trending-up /> +12.5%</x-ui.badge></x-ui.card-action>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <x-ui.chart type="area" :height="180" :series="[['name' => 'Revenue', 'data' => [120, 200, 150, 280, 230, 320, 290, 380]]]"
                            :colors="['var(--primary)']"
                            :options="['xaxis' => ['categories' => ['Mon','Tue','Wed','Thu','Fri','Sat','Sun','Mon']], 'yaxis' => ['show' => false], 'fill' => ['type' => 'gradient', 'gradient' => ['opacityFrom' => 0.4, 'opacityTo' => 0.05, 'stops' => [0, 100]]], 'stroke' => ['width' => 2]]"
                            class="aspect-auto h-[180px]" />
                    </x-ui.card-content>
                </x-ui.card>

                <div class="flex items-center justify-center">
                    <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" class="bg-card w-full rounded-xl border shadow-sm" />
                </div>

                <x-ui.card variant="sectioned">
                    <x-ui.card-header>
                        <x-ui.card-title>Create account</x-ui.card-title>
                        <x-ui.card-description>Enter your email to get started.</x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content class="space-y-3">
                        <div class="space-y-1.5">
                            <x-ui.label for="hero-email">Email</x-ui.label>
                            <x-ui.input id="hero-email" type="email" placeholder="m@example.com" />
                        </div>
                        <div class="flex items-center gap-2">
                            <x-ui.switch id="hero-switch" :checked="true" />
                            <x-ui.label for="hero-switch">Email me updates</x-ui.label>
                        </div>
                    </x-ui.card-content>
                    <x-ui.card-footer>
                        <x-ui.button class="w-full">Sign up</x-ui.button>
                    </x-ui.card-footer>
                </x-ui.card>

                <div class="bg-card flex flex-col gap-4 rounded-xl border p-5 shadow-sm">
                    <div class="flex flex-wrap gap-2">
                        <x-ui.badge>Default</x-ui.badge>
                        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                        <x-ui.badge variant="outline">Outline</x-ui.badge>
                        <x-ui.badge variant="destructive">Destructive</x-ui.badge>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.button size="sm">Button</x-ui.button>
                        <x-ui.button size="sm" variant="secondary">Secondary</x-ui.button>
                        <x-ui.button size="sm" variant="outline">Outline</x-ui.button>
                        <x-ui.button size="sm" variant="ghost">Ghost</x-ui.button>
                    </div>
                    <x-ui.progress :value="66" />
                    <div class="flex items-center gap-3">
                        <x-ui.avatar class="size-9"><x-ui.avatar-fallback>BU</x-ui.avatar-fallback></x-ui.avatar>
                        <div class="text-sm">
                            <p class="font-medium">blatui</p>
                            <p class="text-muted-foreground text-xs">m@example.com</p>
                        </div>
                        <x-ui.badge variant="outline" class="ml-auto">Pro</x-ui.badge>
                    </div>
                </div>

                <div class="flex items-center">
                    <x-ui.alert>
                        <x-lucide-rocket />
                        <x-ui.alert-title>Ship faster.</x-ui.alert-title>
                        <x-ui.alert-description>Drop in a block and you have a page.</x-ui.alert-description>
                    </x-ui.alert>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ STATS ═══════════════════════════ --}}
    <section class="bg-muted/30 border-b">
        <div class="mx-auto grid max-w-5xl grid-cols-2 px-6 sm:grid-cols-3 md:grid-cols-5">
            @foreach ([[$componentCount, 'Components'], [$variantCount, 'Variants'], [$blockCount, 'Blocks'], [$chartCount, 'Charts'], [$templateCount, 'Templates']] as [$n, $l])
                <div class="px-4 py-8 text-center">
                    <div class="blat-mono text-3xl font-bold tracking-tight sm:text-4xl">{{ $n }}</div>
                    <div class="text-muted-foreground mt-1 text-sm">{{ $l }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════════════════ FEATURES ═══════════════════════════ --}}
    <section class="border-b">
        <div class="mx-auto max-w-screen-xl px-6 py-16 lg:px-8 lg:py-24">
            <div class="mx-auto mb-12 max-w-2xl text-center">
                <p class="blat-mono blat-brand-text mb-3 text-[11px] font-medium tracking-[0.14em] uppercase">// why blatui</p>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Everything you need. Nothing you don't.</h2>
                <p class="text-muted-foreground mt-3 text-lg">Built the Laravel way — Blade components, Alpine for interactivity, Tailwind v4 for style.</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as $f)
                    <div class="blat-card bg-card rounded-xl border p-6 shadow-sm">
                        <div class="blat-icon-tile mb-4 flex size-10 items-center justify-center rounded-lg">
                            <x-dynamic-component :component="'lucide-'.$f['icon']" class="size-5" />
                        </div>
                        <h3 class="font-semibold">{{ $f['title'] }}</h3>
                        <p class="text-muted-foreground mt-1.5 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ CODE SHOWCASE ═══════════════════════════ --}}
    <section class="bg-muted/30 border-b">
        <div class="mx-auto max-w-screen-xl px-6 py-16 lg:px-8 lg:py-24">
            <div class="grid items-center gap-10 lg:grid-cols-2">
                <div class="min-w-0">
                    <p class="blat-mono blat-brand-text mb-3 text-[11px] font-medium tracking-[0.14em] uppercase">// the workflow</p>
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Add it. Read it. Own it.</h2>
                    <p class="text-muted-foreground mt-4 text-base">
                        One Artisan command copies a real Blade file into your project. No compiled dependency, no magic — just readable markup you can edit, theme and keep forever.
                    </p>
                    <ul class="mt-6 space-y-3">
                        @foreach (['php artisan blatui:add <name> — copy a component', 'Plain Blade + Alpine you can read and edit', 'Restyle with CSS variables, not forks', 'shadcn-compatible registry & MCP server'] as $point)
                            <li class="flex items-start gap-2.5 text-sm">
                                <x-lucide-check class="mt-0.5 size-4 shrink-0" style="color: var(--blat-brand-ink);" />
                                <span class="text-muted-foreground blat-mono text-[13px]">{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-7 flex gap-2">
                        <a href="/docs" class="bg-card hover:bg-accent inline-flex h-10 items-center gap-1.5 rounded-md border px-4 text-sm font-medium transition-colors">
                            <x-lucide-book-open class="size-4" /> Documentation
                        </a>
                        <a href="{{ config('brand.github') }}" target="_blank" rel="noopener" class="hover:bg-accent inline-flex h-10 items-center gap-1.5 rounded-md px-4 text-sm font-medium transition-colors">
                            <x-lucide-github class="size-4" /> GitHub
                        </a>
                    </div>
                </div>

                <div class="min-w-0">
                    <x-ui.code-block filename="resources/views/welcome.blade.php">@verbatim
{{-- Just paste the markup. You own this file. --}}
<x-ui.button>Get started</x-ui.button>

<x-ui.card class="max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Create account</x-ui.card-title>
        <x-ui.card-description>Enter your email below.</x-ui.card-description>
    </x-ui.card-header>
    <x-ui.card-content class="space-y-3">
        <x-ui.input type="email" placeholder="m@example.com" />
        <x-ui.button class="w-full">Sign up</x-ui.button>
    </x-ui.card-content>
</x-ui.card>
@endverbatim</x-ui.code-block>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ TEMPLATES SHOWCASE ═══════════════════════════ --}}
    <section class="relative overflow-hidden border-b">
        <div class="blat-dotgrid pointer-events-none absolute inset-0 -z-10 opacity-40 [mask-image:radial-gradient(ellipse_at_center,black,transparent_80%)]"></div>
        <div class="mx-auto max-w-screen-xl px-6 py-16 lg:px-8 lg:py-24">
            <div class="mx-auto mb-12 max-w-2xl text-center">
                <p class="blat-mono blat-brand-text mb-3 text-[11px] font-medium tracking-[0.14em] uppercase">// templates</p>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $templateCount }} page templates. One library.</h2>
                <p class="text-muted-foreground mt-3 text-lg">Full pages assembled from the same components — from SaaS landings and storefronts to brutalist studios and glassmorphism dashboards.</p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($flagships as [$slug, $title, $kind, $tag])
                    <a href="/templates/{{ $slug }}" class="blat-card bg-card group rounded-xl border p-5 shadow-sm">
                        <div class="flex items-center justify-between">
                            <span class="blat-mono text-base font-semibold">{{ $title }}</span>
                            <x-lucide-arrow-up-right class="text-muted-foreground size-4 transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                        </div>
                        <p class="text-muted-foreground mt-1 text-xs">{{ $kind }}</p>
                        <span class="blat-pill blat-mono mt-3 inline-block rounded px-1.5 py-0.5 text-[10px]">{{ $tag }}</span>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <a href="/templates" class="text-foreground inline-flex items-center gap-1.5 text-sm font-medium hover:underline">
                    Browse all {{ $templateCount }} templates <x-lucide-arrow-right class="size-4" />
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ EXPLORE ═══════════════════════════ --}}
    <section class="border-b">
        <div class="mx-auto max-w-screen-xl px-6 py-16 lg:px-8 lg:py-20">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($explore as [$title, $count, $desc, $href, $icon])
                    <a href="{{ $href }}" class="blat-card bg-card group relative overflow-hidden rounded-xl border p-6 shadow-sm">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="blat-icon-tile flex size-10 items-center justify-center rounded-lg">
                                <x-dynamic-component :component="'lucide-'.$icon" class="size-5" />
                            </div>
                            <span class="blat-mono text-2xl font-bold tabular-nums">{{ $count }}</span>
                        </div>
                        <h3 class="flex items-center gap-1.5 text-lg font-semibold">{{ $title }}
                            <x-lucide-arrow-right class="size-4 transition-transform group-hover:translate-x-1" />
                        </h3>
                        <p class="text-muted-foreground mt-1 text-sm">{{ $desc }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════ CTA ═══════════════════════════ --}}
    <section class="border-b">
        <div class="mx-auto max-w-5xl px-6 py-16 lg:py-24">
            <div class="relative overflow-hidden rounded-2xl border p-8 text-center sm:p-12 lg:p-16">
                <div class="blat-dotgrid pointer-events-none absolute inset-0 opacity-50"></div>
                <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                    <div class="h-56 w-[28rem] max-w-full rounded-full blur-3xl" style="background: radial-gradient(ellipse, color-mix(in srgb, var(--blat-brand) 16%, transparent) 0%, transparent 70%);"></div>
                </div>
                <div class="relative">
                    <span class="blat-pill blat-mono mb-5 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs">
                        <x-lucide-rocket class="size-3.5" /> MIT licensed · free forever
                    </span>
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Start building in minutes.</h2>
                    <p class="text-muted-foreground mt-3 text-lg">Initialize once, then add any component on demand.</p>

                    <div class="bg-card mx-auto mt-7 max-w-md rounded-lg border p-4 text-left shadow-sm">
                        <div class="blat-mono text-muted-foreground text-sm"><span style="color: var(--blat-brand-ink);">$</span> php artisan blatui:init</div>
                        <div class="blat-mono mt-1 text-sm"><span style="color: var(--blat-brand-ink);">$</span> php artisan blatui:add button card dialog</div>
                    </div>

                    <div class="mt-7 flex flex-wrap justify-center gap-3">
                        <a href="/docs" class="blat-glow-btn blat-brand-fill inline-flex h-11 items-center gap-1.5 rounded-md px-5 text-sm font-semibold">
                            Get started <x-lucide-arrow-right class="size-4" />
                        </a>
                        <a href="/components" class="bg-card hover:bg-accent inline-flex h-11 items-center gap-1.5 rounded-md border px-5 text-sm font-medium transition-colors">
                            Browse components
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-site.footer />
</x-layouts.app>
