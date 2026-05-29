@php
    $files = collect(glob(resource_path('views/charts/*.blade.php')))
        ->map(fn ($p) => basename($p, '.blade.php'))
        ->reject(fn ($n) => $n === 'index')
        ->values();

    $order = ['chart-area' => 'Area', 'chart-bar' => 'Bar', 'chart-line' => 'Line', 'chart-pie' => 'Pie', 'chart-radar' => 'Radar', 'chart-radial' => 'Radial', 'chart-tooltip' => 'Tooltip'];

    $groups = collect($order)->mapWithKeys(function ($label, $prefix) use ($files) {
        $items = $files->filter(fn ($n) => str_starts_with($n, $prefix))->sort()->values();
        return [$label => $items];
    })->filter(fn ($items) => $items->isNotEmpty());

    $total = $files->count();
@endphp

<x-layouts.app title="Charts" description="70 themeable charts for Laravel — area, bar, line, pie, radar and radial — built on ApexCharts and styled with CSS variables.">
    <x-site.header active="charts" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[700px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-6xl px-6 py-14 lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-chart-column class="size-3.5" /> {{ $total }} charts
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Charts</h1>
            <p class="text-muted-foreground mt-3 max-w-2xl text-lg">
                Area, bar, line, pie, radar &amp; radial — built on ApexCharts and themed entirely with your CSS variables.
                Change the accent in <span class="text-foreground font-medium">Customize</span> and watch every chart recolor.
            </p>
        </div>
    </section>

    <div class="mx-auto w-full max-w-6xl px-6 py-12 lg:px-8">
        @forelse ($groups as $label => $charts)
            <section class="mb-16 scroll-mt-20">
                <div class="mb-5 flex items-baseline gap-3">
                    <h2 class="text-2xl font-semibold tracking-tight">{{ $label }}</h2>
                    <span class="text-muted-foreground text-sm">{{ $charts->count() }} {{ \Illuminate\Support\Str::plural('chart', $charts->count()) }}</span>
                </div>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($charts as $chart)
                        <x-gallery-card kind="charts" :slug="$chart" :label="$chart" ratio="aspect-[4/3]" />
                    @endforeach
                </div>
            </section>
        @empty
            <p class="text-muted-foreground">Charts coming soon.</p>
        @endforelse
    </div>
</x-layouts.app>
