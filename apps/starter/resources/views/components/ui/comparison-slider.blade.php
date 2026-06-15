{{--
    Comparison Slider — a before/after image comparison with a draggable divider.
      before/after        image src for each side ("after" is the full base layer,
                          "before" is clipped on top to the slider position).
      beforeLabel/afterLabel  optional corner captions (e.g. "Before" / "After").
      beforeAlt/afterAlt  alt text for each image.
      value               initial divider position, 0–100 (default 50).
    A11y: an <input type="range"> is the real, keyboard-operable control
          (arrows/home/end), labelled "Comparison position"; its value drives the
          clip + divider. The divider/handle is decorative (aria-hidden). RTL-safe.
--}}
@props([
    'before' => null,
    'after' => null,
    'beforeLabel' => null,
    'afterLabel' => null,
    'beforeAlt' => '',
    'afterAlt' => '',
    'value' => 50,
])

<div
    data-slot="comparison-slider"
    x-data="{
        pos: @js(max(0, min(100, (float) $value))),
        dragging: false,
        setFromPointer(e) {
            const r = this.$refs.frame.getBoundingClientRect();
            if (!r.width) return;
            let ratio = (e.clientX - r.left) / r.width;
            if (getComputedStyle(this.$refs.frame).direction === 'rtl') ratio = 1 - ratio;
            this.pos = Math.max(0, Math.min(100, ratio * 100));
        },
        start(e) { this.dragging = true; this.setFromPointer(e); },
        move(e) { if (this.dragging) this.setFromPointer(e); },
        stop() { this.dragging = false; },
    }"
    @pointermove.window="move($event)"
    @pointerup.window="stop()"
    {{ $attributes->twMerge('w-full max-w-xl') }}
>
    <div
        x-ref="frame"
        @pointerdown.prevent="start($event)"
        class="relative aspect-[3/2] w-full touch-none overflow-hidden rounded-lg border border-border bg-background select-none"
    >
        {{-- After: full base layer --}}
        <img
            src="{{ $after }}"
            alt="{{ $afterAlt }}"
            draggable="false"
            class="pointer-events-none absolute inset-0 size-full object-cover"
        />

        {{-- Before: clipped on top to the slider position --}}
        <img
            src="{{ $before }}"
            alt="{{ $beforeAlt }}"
            draggable="false"
            :style="'clip-path: inset(0 ' + (100 - pos) + '% 0 0);'"
            class="pointer-events-none absolute inset-0 size-full object-cover"
        />

        {{-- Corner labels --}}
        @if ($beforeLabel)
            <span class="pointer-events-none absolute start-2 top-2 rounded-md bg-foreground/70 px-2 py-0.5 text-xs font-medium text-background">{{ $beforeLabel }}</span>
        @endif
        @if ($afterLabel)
            <span class="pointer-events-none absolute end-2 top-2 rounded-md bg-foreground/70 px-2 py-0.5 text-xs font-medium text-background">{{ $afterLabel }}</span>
        @endif

        {{-- Decorative divider + grab handle (driven by pos) --}}
        <div
            aria-hidden="true"
            class="pointer-events-none absolute inset-y-0 z-10 w-0.5 -translate-x-1/2 bg-background shadow-[0_0_0_1px_rgba(0,0,0,0.12)] rtl:translate-x-1/2"
            :style="'inset-inline-start: ' + pos + '%;'"
        >
            <div class="absolute top-1/2 left-1/2 flex size-9 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full border border-border bg-background text-foreground shadow-md">
                <x-lucide-chevron-left class="size-4" />
                <x-lucide-chevron-right class="-ml-1 size-4" />
            </div>
        </div>

        {{-- Real, keyboard-operable control --}}
        <input
            type="range"
            min="0"
            max="100"
            x-model.number="pos"
            aria-label="Comparison position"
            class="absolute inset-0 z-20 size-full cursor-ew-resize appearance-none bg-transparent opacity-0 focus-visible:opacity-100 focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50"
        />
    </div>
</div>
