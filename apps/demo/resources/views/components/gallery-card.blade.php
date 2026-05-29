@props([
    'kind',        // 'blocks' | 'charts'
    'slug',
    'label' => null,
    'ratio' => 'aspect-[16/10]',
])

@php
    $label = $label ?? \Illuminate\Support\Str::headline($slug);
@endphp

<a href="{{ url('/'.$kind.'/'.$slug) }}"
    class="group bg-card hover:border-ring/60 relative block overflow-hidden rounded-xl border shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
    {{-- Live, scaled preview of the real page (lazy so off-screen ones don't load) --}}
    <div class="bg-muted/20 relative {{ $ratio }} overflow-hidden border-b">
        <iframe src="{{ url('/'.$kind.'/'.$slug.'/raw') }}" loading="lazy" tabindex="-1" aria-hidden="true" title="{{ $label }} preview"
            class="pointer-events-none absolute left-0 top-0 origin-top-left border-0"
            style="width: 400%; height: 400%; transform: scale(0.25);"></iframe>
        {{-- subtle overlay on hover --}}
        <div class="from-primary/10 absolute inset-0 bg-gradient-to-t to-transparent opacity-0 transition-opacity duration-200 group-hover:opacity-100"></div>
    </div>
    <div class="flex items-center justify-between gap-2 px-4 py-3">
        <span class="truncate text-sm font-medium">{{ $label }}</span>
        <x-lucide-arrow-up-right class="text-muted-foreground size-4 shrink-0 transition-transform duration-200 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
    </div>
</a>
