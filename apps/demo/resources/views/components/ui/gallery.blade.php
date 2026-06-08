{{--
    Gallery — a thumbnail grid that opens a full-screen lightbox with prev/next navigation.
      images   array of items. Each item is either a URL string, or an assoc array:
               ['src' => full image, 'thumb' => optional smaller image, 'alt' => description]
      columns  thumbnail grid columns (default 3)
      rounded  corner rounding utility for thumbnails (default rounded-lg)
    A11y: thumbnails are real <button>s; the lightbox is role="dialog" aria-modal with a focus
          trap (x-trap), Escape to close, ←/→ to navigate, and a polite live counter.
          Directional chevrons mirror under RTL via .blat-rtl-flip.
--}}
@props([
    'images' => [],
    'columns' => 3,
    'rounded' => 'rounded-lg',
])

@php
    $images = collect($images)->map(function ($img) {
        if (is_string($img)) {
            return ['src' => $img, 'thumb' => $img, 'alt' => ''];
        }

        return [
            'src' => $img['src'] ?? '',
            'thumb' => $img['thumb'] ?? ($img['src'] ?? ''),
            'alt' => $img['alt'] ?? '',
        ];
    })->values()->all();

    $gridCols = [
        1 => 'grid-cols-1', 2 => 'grid-cols-2', 3 => 'grid-cols-3',
        4 => 'grid-cols-4', 5 => 'grid-cols-5', 6 => 'grid-cols-6',
    ][max(1, (int) $columns)] ?? 'grid-cols-3';
@endphp

<div
    data-slot="gallery"
    x-data="{
        images: @js($images),
        open: false,
        index: 0,
        show(i) { this.index = i; this.open = true; },
        next() { this.index = (this.index + 1) % this.images.length; },
        prev() { this.index = (this.index - 1 + this.images.length) % this.images.length; },
        get current() { return this.images[this.index] || {}; }
    }"
    {{ $attributes->twMerge('block') }}
>
    <div class="grid {{ $gridCols }} gap-2">
        @foreach ($images as $i => $img)
            <button
                type="button"
                @click="show({{ $i }})"
                aria-label="{{ $img['alt'] !== '' ? 'View image: '.$img['alt'] : 'View image '.($i + 1) }}"
                class="group bg-muted focus-visible:ring-ring relative aspect-square overflow-hidden {{ $rounded }} border outline-none focus-visible:ring-2 focus-visible:ring-offset-2"
            >
                <img src="{{ $img['thumb'] }}" alt="{{ $img['alt'] }}" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />
            </button>
        @endforeach
    </div>

    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            class="fixed inset-0 z-50"
            @keydown.escape.window="open = false"
            @keydown.arrow-right.window="open && next()"
            @keydown.arrow-left.window="open && prev()"
        >
            <div x-show="open" @click="open = false" aria-hidden="true" x-transition.opacity class="fixed inset-0 bg-black/90"></div>

            <div
                x-show="open"
                x-trap.noscroll.inert="open"
                role="dialog"
                aria-modal="true"
                aria-label="Image gallery"
                tabindex="-1"
                x-transition.opacity
                class="fixed inset-0 z-50 flex flex-col"
            >
                <div class="flex items-center justify-between p-4 text-white">
                    <span class="text-sm tabular-nums" aria-live="polite" x-text="(index + 1) + ' / ' + images.length"></span>
                    <button type="button" @click="open = false" aria-label="Close" class="rounded-md p-2 opacity-80 outline-none transition-opacity hover:opacity-100 focus-visible:ring-2 focus-visible:ring-white/60">
                        <x-lucide-x class="size-5" />
                    </button>
                </div>

                <div class="relative flex flex-1 items-center justify-center px-4 pb-6" @click.self="open = false">
                    <button
                        type="button"
                        x-show="images.length > 1"
                        @click="prev()"
                        aria-label="Previous image"
                        class="absolute start-3 top-1/2 grid size-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white outline-none backdrop-blur transition hover:bg-white/20 focus-visible:ring-2 focus-visible:ring-white/70"
                    >
                        <x-lucide-chevron-left class="blat-rtl-flip size-6" />
                    </button>

                    <img :src="current.src" :alt="current.alt" class="max-h-full max-w-full rounded-lg object-contain shadow-2xl" />

                    <button
                        type="button"
                        x-show="images.length > 1"
                        @click="next()"
                        aria-label="Next image"
                        class="absolute end-3 top-1/2 grid size-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white outline-none backdrop-blur transition hover:bg-white/20 focus-visible:ring-2 focus-visible:ring-white/70"
                    >
                        <x-lucide-chevron-right class="blat-rtl-flip size-6" />
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
