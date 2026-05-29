@php
    // Auto-discover block views so this index stays in sync as blocks are added.
    $files = collect(glob(resource_path('views/blocks/*.blade.php')))
        ->map(fn ($p) => basename($p, '.blade.php'))
        ->reject(fn ($n) => $n === 'index')
        ->values();

    $order = ['dashboard' => 'Dashboard', 'sidebar' => 'Sidebar', 'login' => 'Login', 'signup' => 'Sign Up', 'calendar' => 'Calendars'];

    $groups = collect($order)->mapWithKeys(function ($label, $prefix) use ($files) {
        $items = $files->filter(fn ($n) => str_starts_with($n, $prefix.'-'))->sort()->values();
        return [$label => $items];
    })->filter(fn ($items) => $items->isNotEmpty());

    $total = $files->count();
@endphp

<x-layouts.app title="Blocks" description="62 ready-made Laravel UI blocks — dashboards, authentication, sidebars and calendars. Live previews; copy the Blade source.">
    <x-site.header active="blocks" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[700px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-6xl px-6 py-14 lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-layout-template class="size-3.5" /> {{ $total }} blocks
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Blocks</h1>
            <p class="text-muted-foreground mt-3 max-w-2xl text-lg">
                Full-page layouts — dashboards, auth screens, sidebars and calendars. Live previews below;
                click any block to inspect, resize and copy the source.
            </p>
        </div>
    </section>

    <div class="mx-auto w-full max-w-6xl px-6 py-12 lg:px-8">
        @foreach ($groups as $label => $blocks)
            <section class="mb-16 scroll-mt-20" id="{{ \Illuminate\Support\Str::slug($label) }}">
                <div class="mb-5 flex items-baseline gap-3">
                    <h2 class="text-2xl font-semibold tracking-tight">{{ $label }}</h2>
                    <span class="text-muted-foreground text-sm">{{ $blocks->count() }} {{ \Illuminate\Support\Str::plural('block', $blocks->count()) }}</span>
                </div>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blocks as $block)
                        <x-gallery-card kind="blocks" :slug="$block" :label="$block" />
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-layouts.app>
