@php
    // Only show templates that actually have a blade file; config drives order + copy.
    $existing = collect(glob(resource_path('views/templates/*.blade.php')))
        ->map(fn ($p) => basename($p, '.blade.php'))
        ->reject(fn ($n) => $n === 'index')
        ->flip();

    $categories = collect(config('templates.categories'))
        ->map(fn ($items) => collect($items)->filter(fn ($meta, $slug) => $existing->has($slug)))
        ->filter(fn ($items) => $items->isNotEmpty());

    $total = $categories->sum(fn ($items) => $items->count());
@endphp

<x-layouts.app title="Templates" description="Full, real-world page templates built with BlatUI — SaaS landings, storefronts, dashboards and more. Live previews; copy the Blade source and own it.">
    <x-site.header active="templates" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[760px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-6xl px-6 py-16 lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-layout-template class="size-3.5" /> {{ $total }} {{ \Illuminate\Support\Str::plural('template', $total) }}
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Templates</h1>
            <p class="text-muted-foreground mt-3 max-w-2xl text-lg text-balance">
                Complete, production-shaped pages — a tier above blocks. Each one assembles dozens of
                components into a real-world layout. Preview live, then copy the Blade and make it yours.
            </p>
        </div>
    </section>

    <div class="mx-auto w-full max-w-6xl px-6 py-12 lg:px-8">
        @forelse ($categories as $label => $items)
            <section class="mb-16 scroll-mt-20" id="{{ \Illuminate\Support\Str::slug($label) }}">
                <div class="mb-5 flex items-baseline gap-3">
                    <h2 class="text-2xl font-semibold tracking-tight">{{ $label }}</h2>
                    <span class="text-muted-foreground text-sm">{{ $items->count() }} {{ \Illuminate\Support\Str::plural('template', $items->count()) }}</span>
                </div>
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    @foreach ($items as $slug => $meta)
                        <a href="{{ url('/templates/'.$slug) }}"
                            class="group bg-card hover:border-ring/60 relative block overflow-hidden rounded-xl border shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                            <div class="bg-muted/20 relative aspect-[16/10] overflow-hidden border-b">
                                <iframe src="{{ url('/templates/'.$slug.'/raw') }}" loading="lazy" tabindex="-1" aria-hidden="true" title="{{ $meta['title'] }} preview"
                                    class="pointer-events-none absolute left-0 top-0 origin-top-left border-0"
                                    style="width: 400%; height: 400%; transform: scale(0.25);"></iframe>
                                <div class="from-primary/10 absolute inset-0 bg-gradient-to-t to-transparent opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
                            </div>
                            <div class="flex items-start justify-between gap-3 px-5 py-4">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold">{{ $meta['title'] }}</span>
                                    </div>
                                    <p class="text-muted-foreground mt-0.5 text-sm">{{ $meta['description'] }}</p>
                                </div>
                                <x-lucide-arrow-up-right class="text-muted-foreground mt-1 size-4 shrink-0 transition-transform duration-200 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <p class="text-muted-foreground">Templates are on the way.</p>
        @endforelse
    </div>

    <footer class="text-muted-foreground border-t py-8 text-center text-sm">
        Built with Laravel, Blade, Alpine &amp; Tailwind v4. Every template is yours to copy and own.
    </footer>
</x-layouts.app>
