<x-layouts.app>
    <x-site.header />

    {{-- ───────────────────────── Hero ───────────────────────── --}}
    <section class="relative overflow-hidden">
        {{-- glow --}}
        <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 flex justify-center">
            <div class="from-primary/25 h-[480px] w-[820px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="bg-[radial-gradient(var(--border)_1px,transparent_1px)] [background-size:22px_22px] pointer-events-none absolute inset-0 -z-10 opacity-40 [mask-image:radial-gradient(ellipse_at_center,black,transparent_75%)]"></div>

        <div class="mx-auto max-w-3xl px-6 pt-20 pb-14 text-center md:pt-28">
            <a href="/components" class="bg-background/60 hover:bg-accent mb-6 inline-flex items-center gap-2 rounded-full border px-3 py-1 text-sm shadow-sm backdrop-blur transition-colors">
                <span class="bg-primary size-1.5 rounded-full"></span>
                55 components · 62 blocks · 70 charts
                <x-lucide-arrow-right class="size-3.5" />
            </a>
            <h1 class="text-5xl font-bold tracking-tight text-balance md:text-7xl">
                Beautiful Laravel UI.<br>
                <span class="text-primary">Copy, paste, own it.</span>
            </h1>
            <p class="text-muted-foreground mx-auto mt-6 max-w-xl text-lg text-balance">
                The complete shadcn/ui experience — faithfully ported to Blade, Alpine &amp; Tailwind v4.
                No npm runtime, no lock-in. Just clean components you own.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <x-ui.button href="/components" size="lg">Browse components <x-lucide-arrow-right /></x-ui.button>
                <x-ui.button href="/blocks" size="lg" variant="outline">Explore blocks</x-ui.button>
            </div>
            <div class="text-muted-foreground mx-auto mt-6 flex w-fit items-center gap-2 rounded-lg border bg-card/60 px-3 py-2 font-mono text-sm backdrop-blur"
                x-data="{ copied: false, copy() { navigator.clipboard.writeText('composer require blatui/blatui'); this.copied = true; setTimeout(() => this.copied = false, 1500); } }">
                <span class="text-muted-foreground/60">$</span> composer require blatui/blatui
                <button type="button" @click="copy()" class="hover:text-foreground ml-1">
                    <x-lucide-copy class="size-3.5" x-show="!copied" />
                    <x-lucide-check class="size-3.5 text-emerald-500" x-show="copied" x-cloak />
                </button>
            </div>
            <p class="text-muted-foreground/80 mt-4 text-xs">
                Hit <span class="text-foreground font-medium">Customize</span> in the top-right — the whole page restyles live.
            </p>
        </div>

        {{-- ── Live component bento (reacts to the customizer) ── --}}
        <div class="mx-auto max-w-6xl px-6 pb-20">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                {{-- Stat + chart --}}
                <x-ui.card class="md:col-span-2">
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

                {{-- Calendar --}}
                <div class="flex items-center justify-center">
                    <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" class="w-full rounded-xl border shadow-sm" />
                </div>

                {{-- Form card --}}
                <x-ui.card>
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

                {{-- Controls cluster --}}
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
                        <x-ui.avatar class="size-9"><x-ui.avatar-fallback>CN</x-ui.avatar-fallback></x-ui.avatar>
                        <div class="text-sm">
                            <p class="font-medium">shadcn</p>
                            <p class="text-muted-foreground text-xs">m@example.com</p>
                        </div>
                        <x-ui.badge variant="outline" class="ml-auto">Pro</x-ui.badge>
                    </div>
                </div>

                {{-- Alert --}}
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

    {{-- ───────────────────────── Stats ───────────────────────── --}}
    <section class="border-y bg-muted/30">
        <div class="mx-auto grid max-w-5xl grid-cols-2 gap-px px-6 py-2 md:grid-cols-4">
            @foreach ([['55', 'Components'], ['62', 'Blocks'], ['70', 'Charts'], ['∞', 'Themes']] as [$n, $l])
                <div class="px-4 py-8 text-center">
                    <div class="text-4xl font-bold tracking-tight">{{ $n }}</div>
                    <div class="text-muted-foreground mt-1 text-sm">{{ $l }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ───────────────────────── Features ───────────────────────── --}}
    <section class="mx-auto max-w-6xl px-6 py-20">
        <div class="mx-auto mb-12 max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight md:text-4xl">Everything you need. Nothing you don't.</h2>
            <p class="text-muted-foreground mt-3 text-lg">Built the Laravel way — Blade components, Alpine for interactivity, Tailwind v4 for style.</p>
        </div>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ([
                ['copy', 'You own the code', 'Components are copied into your project with one Artisan command. No black-box dependency.'],
                ['paintbrush', 'Themeable to the core', 'Every token is a CSS variable. Recolor, restyle and export your theme in seconds.'],
                ['zap', 'Zero JS runtime', 'No React, no build-step lock-in. Just Blade + a sprinkle of Alpine you can read.'],
                ['layout-template', '62 ready blocks', 'Full dashboards, auth pages, sidebars and calendars — paste and go.'],
                ['chart-column', '70 charts', 'Area, bar, line, pie, radar and radial — powered by ApexCharts, themed automatically.'],
                ['moon', 'Dark mode built-in', 'Every component ships light + dark, switchable instantly and persisted.'],
            ] as [$icon, $title, $desc])
                <div class="bg-card hover:border-ring/50 rounded-xl border p-6 shadow-sm transition-colors">
                    <div class="bg-primary/10 text-primary mb-4 flex size-10 items-center justify-center rounded-lg">
                        <x-dynamic-component :component="'lucide-'.$icon" class="size-5" />
                    </div>
                    <h3 class="font-semibold">{{ $title }}</h3>
                    <p class="text-muted-foreground mt-1.5 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ───────────────────────── Three ways ───────────────────────── --}}
    <section class="mx-auto max-w-6xl px-6 pb-20">
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ([
                ['Components', '55 building blocks', '/components', 'component'],
                ['Blocks', '62 full-page layouts', '/blocks', 'layout-template'],
                ['Charts', '70 data visualizations', '/charts', 'chart-column'],
            ] as [$title, $desc, $href, $icon])
                <a href="{{ $href }}" class="group bg-card hover:border-ring relative overflow-hidden rounded-xl border p-6 shadow-sm transition-colors">
                    <div class="from-primary/10 absolute inset-0 -z-10 bg-gradient-to-br to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                    <x-dynamic-component :component="'lucide-'.$icon" class="text-muted-foreground mb-4 size-6" />
                    <h3 class="flex items-center gap-1.5 text-lg font-semibold">{{ $title }} <x-lucide-arrow-right class="size-4 transition-transform group-hover:translate-x-1" /></h3>
                    <p class="text-muted-foreground mt-1 text-sm">{{ $desc }}</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ───────────────────────── CTA ───────────────────────── --}}
    <section class="border-t">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center">
            <h2 class="text-3xl font-bold tracking-tight md:text-4xl">Start building in minutes.</h2>
            <p class="text-muted-foreground mt-3 text-lg">Initialize once, then add any component on demand.</p>
            <div class="bg-card mx-auto mt-6 w-fit rounded-lg border px-4 py-3 text-left font-mono text-sm shadow-sm">
                <div class="text-muted-foreground">php artisan blatui:init</div>
                <div>php artisan blatui:add button card dialog</div>
            </div>
            <div class="mt-8 flex justify-center gap-3">
                <x-ui.button href="/docs" size="lg">Get started <x-lucide-arrow-right /></x-ui.button>
            </div>
        </div>
    </section>

    <footer class="text-muted-foreground border-t py-8 text-center text-sm">
        Built with Laravel, Blade, Alpine &amp; Tailwind v4. Inspired by shadcn/ui.
    </footer>
</x-layouts.app>
