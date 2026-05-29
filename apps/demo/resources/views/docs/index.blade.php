@php
    $categories = config('docs.categories');
    $available = collect(glob(resource_path('views/examples/*'), GLOB_ONLYDIR))->map(fn ($p) => basename($p))->all();
    $total = collect($categories)->flatten()->count();
    $ready = collect($categories)->flatten()->filter(fn ($s) => in_array($s, $available))->count();
@endphp

<x-layouts.docs title="Components" description="55 accessible UI components for Laravel Blade, faithfully ported from shadcn/ui. Copy-paste, fully themeable." active="">
    <div class="space-y-3">
        <h1 class="text-4xl font-bold tracking-tight">Components</h1>
        <p class="text-muted-foreground text-lg">
            {{ $total }} accessible components, faithfully ported from shadcn/ui to Blade + Alpine.
            Copy the source for any example — you own the code.
        </p>
        <div class="flex flex-wrap gap-2 pt-1 text-sm">
            <a href="/blocks" class="bg-secondary text-secondary-foreground hover:bg-secondary/80 inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 font-medium">
                <x-lucide-layout-template class="size-4" /> 62 Blocks
            </a>
            <a href="/charts" class="bg-secondary text-secondary-foreground hover:bg-secondary/80 inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 font-medium">
                <x-lucide-chart-column class="size-4" /> 70 Charts
            </a>
        </div>
    </div>

    @foreach ($categories as $label => $items)
        <section class="mt-10">
            <h2 class="text-muted-foreground mb-3 text-xs font-semibold tracking-wide uppercase">{{ $label }}</h2>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                @foreach ($items as $slug)
                    @php $has = in_array($slug, $available); @endphp
                    <a href="{{ $has ? route('docs.component', $slug) : '#' }}"
                        @class([
                            'flex items-center justify-between rounded-lg border p-3 text-sm transition-colors',
                            'bg-card hover:border-ring hover:bg-accent/30' => $has,
                            'opacity-50 cursor-not-allowed' => ! $has,
                        ])>
                        <span class="font-medium capitalize">{{ str_replace('-', ' ', $slug) }}</span>
                        @if ($has)
                            <x-lucide-arrow-right class="text-muted-foreground size-4" />
                        @else
                            <span class="text-muted-foreground/60 text-[10px]">soon</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</x-layouts.docs>
