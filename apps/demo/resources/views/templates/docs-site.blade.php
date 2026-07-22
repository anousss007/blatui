@php
    $toc = ['Overview' => 'overview', 'Requirements' => 'requirements', 'Install the package' => 'install', 'Configuration' => 'config', 'Next steps' => 'next'];
@endphp

<x-layouts.app title="Installation — Helix Docs">
    {{-- Header --}}
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-screen-2xl items-center gap-3 px-4 lg:px-6">
            <x-ui.sheet>
                <x-ui.sheet-trigger class="lg:hidden">
                    <x-ui.button variant="outline" size="icon" aria-label="Menu"><x-lucide-menu class="size-4" /></x-ui.button>
                </x-ui.sheet-trigger>
                <x-ui.sheet-content side="left" class="w-72">
                    <x-ui.sheet-header><x-ui.sheet-title>Documentation</x-ui.sheet-title></x-ui.sheet-header>
                    <div class="overflow-y-auto px-4 pb-4">@include('templates.partials.docs-nav')</div>
                </x-ui.sheet-content>
            </x-ui.sheet>

            <a href="#" class="flex items-center gap-2 font-semibold"><span class="bg-primary text-primary-foreground flex size-7 items-center justify-center rounded-lg"><x-lucide-hexagon class="size-4" /></span> Helix</a>
            <x-ui.badge variant="outline" class="hidden text-xs sm:inline-flex">v3.2</x-ui.badge>

            <div class="relative ml-auto hidden sm:block">
                <x-ui.input type="search" placeholder="Search docs…" class="h-9 w-60 pe-12">
                    <x-slot:leading><x-lucide-search /></x-slot:leading>
                </x-ui.input>
                <x-ui.kbd class="absolute right-1.5 top-1/2 -translate-y-1/2">⌘K</x-ui.kbd>
            </div>
            <div class="ml-auto flex items-center gap-1.5 sm:ml-0">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <a href="#" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="GitHub"><x-lucide-github class="size-4" /></a>
            </div>
        </div>
    </header>

    <div class="mx-auto flex max-w-screen-2xl gap-8 px-4 lg:px-6">
        {{-- Left nav --}}
        <aside class="sticky top-16 hidden h-[calc(100vh-4rem)] w-60 shrink-0 overflow-y-auto py-8 lg:block">@include('templates.partials.docs-nav')</aside>

        {{-- Content --}}
        <main class="min-w-0 flex-1 py-8 lg:max-w-3xl">
            <x-ui.breadcrumb class="mb-4">
                <x-ui.breadcrumb-list>
                    <x-ui.breadcrumb-item><x-ui.breadcrumb-link href="#">Docs</x-ui.breadcrumb-link></x-ui.breadcrumb-item>
                    <x-ui.breadcrumb-separator />
                    <x-ui.breadcrumb-item><x-ui.breadcrumb-link href="#">Getting Started</x-ui.breadcrumb-link></x-ui.breadcrumb-item>
                    <x-ui.breadcrumb-separator />
                    <x-ui.breadcrumb-item><x-ui.breadcrumb-page>Installation</x-ui.breadcrumb-page></x-ui.breadcrumb-item>
                </x-ui.breadcrumb-list>
            </x-ui.breadcrumb>

            <h1 class="scroll-mt-20 text-4xl font-bold tracking-tight" id="overview">Installation</h1>
            <p class="text-muted-foreground mt-3 text-lg text-balance">Get Helix running in your project in under five minutes. This guide covers requirements, installation and the one config file you'll touch.</p>

            <h2 id="requirements" class="mt-10 scroll-mt-20 border-b pb-2 text-xl font-semibold">Requirements</h2>
            <p class="mt-4 leading-relaxed">Helix runs anywhere Node 18+ does. Before you start, make sure you have:</p>
            <ul class="mt-3 list-disc space-y-1.5 pl-6 text-sm leading-relaxed">
                <li>Node.js <code class="bg-muted rounded px-1.5 py-0.5 text-xs">18.0</code> or newer</li>
                <li>A package manager (npm, pnpm or bun)</li>
                <li>A project with a bundler (Vite recommended)</li>
            </ul>

            <h2 id="install" class="mt-10 scroll-mt-20 border-b pb-2 text-xl font-semibold">Install the package</h2>
            <p class="mt-4 leading-relaxed">Add Helix and its peer dependencies with your package manager of choice:</p>
            <div class="bg-foreground text-background mt-4 overflow-x-auto rounded-lg p-4 font-mono text-sm" x-data="{ copied: false }">
                <div class="flex items-start justify-between gap-4">
                    <pre class="whitespace-pre"><span class="opacity-50">$</span> npm install helix-ui @helix/core</pre>
                    <button @click="navigator.clipboard.writeText('npm install helix-ui @helix/core'); copied = true; setTimeout(() => copied = false, 1500)" class="opacity-70 hover:opacity-100" aria-label="Copy">
                        <x-lucide-copy class="size-4" x-show="!copied" /><x-lucide-check class="size-4" x-show="copied" x-cloak />
                    </button>
                </div>
            </div>

            <x-ui.alert tone="info" class="mt-6">
                <x-lucide-info />
                <x-ui.alert-title>Using a monorepo?</x-ui.alert-title>
                <x-ui.alert-description>Install Helix in the workspace root and reference it from each package — the CLI resolves config upward automatically.</x-ui.alert-description>
            </x-ui.alert>

            <h2 id="config" class="mt-10 scroll-mt-20 border-b pb-2 text-xl font-semibold">Configuration</h2>
            <p class="mt-4 leading-relaxed">Helix reads a single <code class="bg-muted rounded px-1.5 py-0.5 text-xs">helix.config.js</code> at your project root. Every option is optional — these are the defaults:</p>

            <div class="mt-4 overflow-hidden rounded-lg border">
                <x-ui.table>
                    <x-ui.table-header>
                        <x-ui.table-row><x-ui.table-head>Option</x-ui.table-head><x-ui.table-head>Type</x-ui.table-head><x-ui.table-head>Default</x-ui.table-head></x-ui.table-row>
                    </x-ui.table-header>
                    <x-ui.table-body>
                        @foreach ([['theme', 'string', '"system"'], ['prefix', 'string', '"hx-"'], ['strict', 'boolean', 'false'], ['outDir', 'string', '"./dist"']] as [$o, $t, $d])
                            <x-ui.table-row>
                                <x-ui.table-cell class="font-mono text-xs font-medium">{{ $o }}</x-ui.table-cell>
                                <x-ui.table-cell class="text-muted-foreground font-mono text-xs">{{ $t }}</x-ui.table-cell>
                                <x-ui.table-cell class="font-mono text-xs">{{ $d }}</x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    </x-ui.table-body>
                </x-ui.table>
            </div>

            <x-ui.alert tone="warning" class="mt-6">
                <x-lucide-triangle-alert />
                <x-ui.alert-title>Strict mode changes resolution</x-ui.alert-title>
                <x-ui.alert-description>Turning on <code class="rounded bg-black/10 px-1 text-xs dark:bg-white/10">strict</code> will fail the build on any unresolved token. Enable it once your theme is stable.</x-ui.alert-description>
            </x-ui.alert>

            <h2 id="next" class="mt-10 scroll-mt-20 border-b pb-2 text-xl font-semibold">Next steps</h2>
            <p class="mt-4 leading-relaxed">You're set up. From here, most people head to theming or pull in their first components.</p>

            {{-- Prev / next --}}
            <div class="mt-10 grid gap-4 sm:grid-cols-2">
                <a href="#" class="hover:border-ring group rounded-lg border p-4 transition-colors">
                    <div class="text-muted-foreground flex items-center gap-1 text-xs"><x-lucide-arrow-left class="size-3.5" /> Previous</div>
                    <div class="group-hover:text-primary mt-1 font-medium transition-colors">Introduction</div>
                </a>
                <a href="#" class="hover:border-ring group rounded-lg border p-4 text-right transition-colors">
                    <div class="text-muted-foreground flex items-center justify-end gap-1 text-xs">Next <x-lucide-arrow-right class="size-3.5" /></div>
                    <div class="group-hover:text-primary mt-1 font-medium transition-colors">Quick start</div>
                </a>
            </div>
        </main>

        {{-- On this page --}}
        <aside class="sticky top-16 hidden h-[calc(100vh-4rem)] w-52 shrink-0 py-8 xl:block">
            <p class="text-muted-foreground mb-3 text-xs font-semibold uppercase tracking-wide">On this page</p>
            <ul class="space-y-2 text-sm">
                @foreach ($toc as $label => $anchor)
                    <li><a href="#{{ $anchor }}" class="text-muted-foreground hover:text-foreground block transition-colors">{{ $label }}</a></li>
                @endforeach
            </ul>
            <x-ui.separator class="my-4" />
            <a href="#" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1.5 text-sm"><x-lucide-pencil class="size-3.5" /> Edit this page</a>
        </aside>
    </div>
</x-layouts.app>
