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
                <p class="text-muted-foreground mt-1 mb-4 text-sm">Install, publish the foundations, wire two entrypoints, then start building.</p>
                <x-code-block label="Terminal" icon="terminal">composer require blatui/blatui gehrisandro/tailwind-merge-laravel mallardduck/blade-lucide-icons
npm install -D alpinejs @alpinejs/anchor @alpinejs/collapse @alpinejs/focus apexcharts tw-animate-css
php artisan vendor:publish --tag=blatui-foundations</x-code-block>
                <p class="text-muted-foreground mt-3 mb-2 text-sm">Point your two Vite entrypoints at the published foundations (replace each file's contents):</p>
                <x-code-block label="resources/css/app.css" icon="palette">@import "./blatui.css";</x-code-block>
                <x-code-block label="resources/js/app.js" icon="file-code">import "./blatui.js";</x-code-block>
                <p class="text-muted-foreground mt-3 mb-2 text-sm">Verify, then add your first components:</p>
                <x-code-block label="Terminal" icon="terminal">php artisan blatui:init
php artisan blatui:add button card input</x-code-block>
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

            <x-step :n="3" title="Publish &amp; import the foundations">
                <p class="text-muted-foreground text-sm">Publish the theme CSS and the Alpine/chart/calendar engine. They land in <code class="bg-muted rounded px-1 py-0.5 text-xs">resources/css/blatui.css</code> and <code class="bg-muted rounded px-1 py-0.5 text-xs">resources/js/blatui.js</code> — and they're yours to edit.</p>
                <x-code-block label="Terminal" icon="terminal">php artisan vendor:publish --tag=blatui-foundations</x-code-block>
                <p class="text-muted-foreground text-sm">Then point your two Vite entrypoints at them — <span class="text-foreground font-medium">replace</span> the contents of each file:</p>
                <x-code-block label="resources/css/app.css" icon="palette">@import "./blatui.css";</x-code-block>
                <x-code-block label="resources/js/app.js" icon="file-code">import "./blatui.js";</x-code-block>
                <div class="bg-muted/40 flex items-start gap-2 rounded-lg border p-3 text-sm">
                    <x-lucide-sparkles class="text-primary mt-0.5 size-4 shrink-0" />
                    <span class="text-muted-foreground"><code class="bg-muted rounded px-1 text-xs">blatui.css</code> bundles Tailwind, <code class="bg-muted rounded px-1 text-xs">tw-animate-css</code>, the design tokens and the <code class="bg-muted rounded px-1 text-xs">@theme</code> mapping; <code class="bg-muted rounded px-1 text-xs">blatui.js</code> boots Alpine + its plugins and lazy-loads ApexCharts. Want a custom palette? Open <span class="text-foreground font-medium">Customize</span> (top-right), tune it, and hit <span class="text-foreground font-medium">Copy theme CSS</span> for a complete, ready-to-paste <code class="bg-muted rounded px-1 text-xs">app.css</code>.</span>
                </div>
            </x-step>

            <x-step :n="4" title="Verify your setup">
                <p class="text-muted-foreground text-sm">Run the doctor. It checks every package, the theme tokens and the Alpine bootstrap — and that the foundations are actually imported — then tells you exactly what's missing.</p>
                <x-code-block label="Terminal" icon="terminal">php artisan blatui:init</x-code-block>
            </x-step>

            <x-step :n="5" title="Add components">
                <p class="text-muted-foreground text-sm">Copy components — and their dependencies — straight into <code class="bg-muted rounded px-1 py-0.5 text-xs">resources/views/components/ui</code>. They're yours now: edit freely.</p>
                <x-code-block label="Terminal" icon="terminal">php artisan blatui:add button card input

# browse everything that's available
php artisan blatui:list</x-code-block>
            </x-step>

            <x-step :n="6" title="Use them" :last="true">
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

            {{-- Existing project --}}
            <div class="mt-10 border-t pt-10">
                <h2 class="mb-2 text-2xl font-bold tracking-tight">Installing into an existing project</h2>
                <p class="text-muted-foreground mb-6 text-sm">Already have a Laravel app with Tailwind set up? Everything is <span class="text-foreground font-medium">additive</span> — you don't replace your files.</p>

                <div class="space-y-5">
                    <div class="bg-muted/40 flex items-start gap-3 rounded-lg border p-4 text-sm">
                        <x-lucide-info class="text-primary mt-0.5 size-4 shrink-0" />
                        <div>
                            <span class="text-foreground font-medium">Tailwind v4 is required.</span>
                            <span class="text-muted-foreground">BlatUI relies on v4-only features (<code class="bg-muted rounded px-1 text-xs">@theme inline</code>, oklch tokens). If you're still on Tailwind v3, migrate first:</span>
                            <div class="mt-2"><x-code-block label="Terminal" icon="terminal">npx @tailwindcss/upgrade</x-code-block></div>
                        </div>
                    </div>

                    <div>
                        <p class="mb-1 text-sm font-medium">CSS — add, don't replace</p>
                        <p class="text-muted-foreground mb-2 text-sm">Append the import to your existing <code class="bg-muted rounded px-1 text-xs">app.css</code> (below your <code class="bg-muted rounded px-1 text-xs">@import "tailwindcss"</code>). The foundations layer on top of your own styles.</p>
                        <x-code-block label="resources/css/app.css" icon="palette">@import "tailwindcss";
/* …your existing styles… */
@import "./blatui.css";</x-code-block>
                    </div>

                    <div>
                        <p class="mb-1 text-sm font-medium">JS — already running Alpine?</p>
                        <p class="text-muted-foreground mb-2 text-sm">Don't import <code class="bg-muted rounded px-1 text-xs">blatui.js</code> (it would boot a second Alpine). Register BlatUI into <span class="text-foreground font-medium">your</span> Alpine instance instead, before you start it:</p>
                        <x-code-block label="resources/js/app.js" icon="file-code">import Alpine from 'alpinejs'
import { registerBlatUI } from './blatui-core.js'

registerBlatUI(Alpine)   // plugins + theme store + chart/calendar engines

window.Alpine = Alpine
Alpine.start()</x-code-block>
                    </div>
                </div>
            </div>

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
                    @foreach (['Install the package' => '1', 'Peer dependencies' => '2', 'Foundations' => '3', 'Verify setup' => '4', 'Add components' => '5', 'Use them' => '6'] as $label => $n)
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
