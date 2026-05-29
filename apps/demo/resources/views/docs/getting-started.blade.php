<x-layouts.app title="Get Started" description="Install Shadlara in any Laravel app — step-by-step setup for Blade components, Tailwind v4 theming and Alpine.js. You own every line of code.">
    <x-site.header active="docs" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[760px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-3xl px-6 py-16 text-center lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-rocket class="size-3.5" /> Get started
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Installation</h1>
            <p class="text-muted-foreground mt-4 text-lg text-balance">
                Add {{ config('brand.name') }} to any Laravel app in a few minutes. You install the foundations once,
                then pull in components on demand — and you own every line.
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-2 text-xs">
                @foreach (['Laravel 11+', 'PHP 8.2+', 'Tailwind CSS v4', 'Alpine.js 3', 'Node 18+'] as $req)
                    <span class="bg-secondary text-secondary-foreground rounded-full px-3 py-1 font-medium">{{ $req }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <div class="mx-auto grid max-w-6xl gap-12 px-6 py-14 lg:grid-cols-[1fr_220px] lg:px-8">
        {{-- Main column --}}
        <div class="min-w-0 max-w-2xl">
            {{-- TL;DR --}}
            <div class="border-primary/20 from-primary/5 mb-12 rounded-2xl border bg-gradient-to-br to-transparent p-6">
                <h2 class="flex items-center gap-2 text-sm font-semibold"><x-lucide-zap class="text-primary size-4" /> TL;DR — already on Laravel + Tailwind v4?</h2>
                <p class="text-muted-foreground mt-1 mb-4 text-sm">Run these three and start building.</p>
                <x-code-block label="Terminal" icon="terminal">composer require blatui/blatui
php artisan blatui:init
php artisan blatui:add button card dialog</x-code-block>
            </div>

            <h2 id="installation" class="mb-6 scroll-mt-20 text-2xl font-bold tracking-tight">Step-by-step</h2>

            <x-step :n="1" title="Install the package">
                <p class="text-muted-foreground text-sm">Pull {{ config('brand.name') }} in via Composer. It ships the Artisan commands and the component registry.</p>
                <x-code-block label="Terminal" icon="terminal">composer require blatui/blatui</x-code-block>
            </x-step>

            <x-step :n="2" title="Install the peer dependencies">
                <p class="text-muted-foreground text-sm">Two Composer packages power the components — <code class="bg-muted rounded px-1 py-0.5 text-xs">twMerge()</code> (the <code class="bg-muted rounded px-1 py-0.5 text-xs">cn()</code> equivalent) and Lucide icons:</p>
                <x-code-block label="Terminal" icon="terminal">composer require gehrisandro/tailwind-merge-laravel mallardduck/blade-lucide-icons</x-code-block>
                <p class="text-muted-foreground text-sm">Then the front-end packages — Alpine, its plugins, and ApexCharts (for the charts):</p>
                <x-code-block label="Terminal" icon="terminal">npm install -D alpinejs @alpinejs/anchor @alpinejs/collapse @alpinejs/focus apexcharts</x-code-block>
            </x-step>

            <x-step :n="3" title="Add the theme tokens">
                <p class="text-muted-foreground text-sm">Drop the shadcn design tokens into <code class="bg-muted rounded px-1 py-0.5 text-xs">resources/css/app.css</code>. This is the heart of the theming system — every component reads these CSS variables.</p>
                <x-code-block label="resources/css/app.css" icon="palette">@import "tailwindcss";
@custom-variant dark (&:is(.dark *));

:root {
  --radius: 0.625rem;
  --background: oklch(1 0 0);
  --foreground: oklch(0.145 0 0);
  --primary: oklch(0.205 0 0);
  --primary-foreground: oklch(0.985 0 0);
  --muted: oklch(0.97 0 0);
  --border: oklch(0.922 0 0);
  /* …card, popover, secondary, accent, destructive, ring, chart-1…5, sidebar… */
}

.dark {
  --background: oklch(0.145 0 0);
  --foreground: oklch(0.985 0 0);
  --primary: oklch(0.985 0 0);
  /* …dark overrides… */
}

@theme inline {
  --color-background: var(--background);
  --color-foreground: var(--foreground);
  --color-primary: var(--primary);
  --radius-lg: var(--radius);
  /* …map every token… */
}</x-code-block>
                <div class="bg-muted/40 flex items-start gap-2 rounded-lg border p-3 text-sm">
                    <x-lucide-sparkles class="text-primary mt-0.5 size-4 shrink-0" />
                    <span class="text-muted-foreground">Don't copy by hand — open <span class="text-foreground font-medium">Customize</span> (top-right), pick your colors, and hit <span class="text-foreground font-medium">Copy theme CSS</span> to grab the complete, ready-to-paste <code class="bg-muted rounded px-1 text-xs">:root</code> / <code class="bg-muted rounded px-1 text-xs">.dark</code> block.</span>
                </div>
            </x-step>

            <x-step :n="4" title="Bootstrap Alpine">
                <p class="text-muted-foreground text-sm">Register Alpine and its plugins in <code class="bg-muted rounded px-1 py-0.5 text-xs">resources/js/app.js</code>. The plugins drive popovers, accordions and focus traps.</p>
                <x-code-block label="resources/js/app.js" icon="file-code">import Alpine from 'alpinejs'
import anchor from '@alpinejs/anchor'
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'

Alpine.plugin(anchor)
Alpine.plugin(collapse)
Alpine.plugin(focus)

window.Alpine = Alpine
Alpine.start()</x-code-block>
            </x-step>

            <x-step :n="5" title="Verify your setup">
                <p class="text-muted-foreground text-sm">Run the doctor. It checks every foundation — packages, theme tokens, Alpine bootstrap — and tells you exactly what's missing.</p>
                <x-code-block label="Terminal" icon="terminal">php artisan blatui:init</x-code-block>
            </x-step>

            <x-step :n="6" title="Add components">
                <p class="text-muted-foreground text-sm">Copy components — and their dependencies — straight into <code class="bg-muted rounded px-1 py-0.5 text-xs">resources/views/components/ui</code>. They're yours now: edit freely.</p>
                <x-code-block label="Terminal" icon="terminal">php artisan blatui:add button card dialog

# browse everything that's available
php artisan blatui:list</x-code-block>
            </x-step>

            <x-step :n="7" title="Use them" :last="true">
                <p class="text-muted-foreground text-sm">Every component is a Blade tag under the <code class="bg-muted rounded px-1 py-0.5 text-xs">ui</code> namespace. Compose away:</p>
                <x-code-block label="resources/views/welcome.blade.php" icon="code">&lt;x-ui.card class="max-w-sm"&gt;
    &lt;x-ui.card-header&gt;
        &lt;x-ui.card-title&gt;Welcome back&lt;/x-ui.card-title&gt;
        &lt;x-ui.card-description&gt;Sign in to continue.&lt;/x-ui.card-description&gt;
    &lt;/x-ui.card-header&gt;
    &lt;x-ui.card-content class="space-y-3"&gt;
        &lt;x-ui.input type="email" placeholder="m@example.com" /&gt;
        &lt;x-ui.button class="w-full"&gt;Sign in&lt;/x-ui.button&gt;
    &lt;/x-ui.card-content&gt;
&lt;/x-ui.card&gt;</x-code-block>
                <div class="rounded-xl border p-6">
                    <p class="text-muted-foreground mb-4 text-xs font-medium tracking-wide uppercase">Renders</p>
                    <div class="flex justify-center">
                        <x-ui.card class="w-full max-w-sm">
                            <x-ui.card-header>
                                <x-ui.card-title>Welcome back</x-ui.card-title>
                                <x-ui.card-description>Sign in to continue.</x-ui.card-description>
                            </x-ui.card-header>
                            <x-ui.card-content class="space-y-3">
                                <x-ui.input type="email" placeholder="m@example.com" />
                                <x-ui.button class="w-full">Sign in</x-ui.button>
                            </x-ui.card-content>
                        </x-ui.card>
                    </div>
                </div>
            </x-step>

            {{-- Next steps --}}
            <div class="mt-8 border-t pt-10">
                <h2 class="mb-5 text-2xl font-bold tracking-tight">What's next</h2>
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach ([['Components', '55 building blocks', '/components', 'component'], ['Blocks', '62 full pages', '/blocks', 'layout-template'], ['Charts', '70 visualizations', '/charts', 'chart-column']] as [$t, $d, $href, $icon])
                        <a href="{{ $href }}" class="group bg-card hover:border-ring rounded-xl border p-5 transition-colors">
                            <x-dynamic-component :component="'lucide-'.$icon" class="text-muted-foreground mb-3 size-5" />
                            <div class="flex items-center gap-1 font-semibold">{{ $t }} <x-lucide-arrow-right class="size-4 transition-transform group-hover:translate-x-0.5" /></div>
                            <p class="text-muted-foreground mt-0.5 text-sm">{{ $d }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- On this page --}}
        <aside class="hidden lg:block">
            <div class="sticky top-20 space-y-3 text-sm">
                <p class="text-muted-foreground text-xs font-semibold tracking-wide uppercase">On this page</p>
                <ul class="space-y-2">
                    @foreach (['Install the package' => '1', 'Peer dependencies' => '2', 'Theme tokens' => '3', 'Bootstrap Alpine' => '4', 'Verify setup' => '5', 'Add components' => '6', 'Use them' => '7'] as $label => $n)
                        <li><a href="#installation" class="text-muted-foreground hover:text-foreground flex items-center gap-2 transition-colors">
                            <span class="bg-muted flex size-5 items-center justify-center rounded text-[11px] font-medium">{{ $n }}</span>{{ $label }}
                        </a></li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>

    <footer class="text-muted-foreground border-t py-8 text-center text-sm">
        Built with Laravel, Blade, Alpine &amp; Tailwind v4. Inspired by shadcn/ui.
    </footer>
</x-layouts.app>
