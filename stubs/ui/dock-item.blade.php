{{--
    Dock Item — one magnifying tile inside <x-ui.dock>. Renders a focusable
    control (an <a> when `href` is set, else a <button>) carrying a lucide icon,
    a hover/focus tooltip, and an optional active dot.

      icon    lucide icon name (e.g. "folder", "mail"); or compose via the slot.
      label   accessible name + the text shown in the hover/focus tooltip.
      href    link target; omit (or "#") for a button-style item.
      active  show the small dot beneath the tile.

    It reads the parent dock's reactive scope (`scaleFor`, inherited via Alpine
    scope chaining), measures its own horizontal centre, and recomputes its
    scale on every pointer move — magnifying with transform-origin at the bottom
    so tiles grow upward out of the bar. `transition-transform` keeps it smooth;
    when the dock reports reduced-motion, scaleFor() returns 1 so it stays put.
--}}
@props([
    'icon' => null,
    'label' => null,
    'href' => '#',
    'active' => false,
])

@php
    // Button-style when there's no real destination; <a> otherwise.
    $isLink = $href && $href !== '#';
    $tag = $isLink ? 'a' : 'button';
@endphp

<div data-slot="dock-item" class="group/dock-item relative flex flex-col items-center">
    {{-- Tooltip label — above the tile, on hover OR keyboard focus. --}}
    @if ($label)
        <span
            data-slot="dock-item-tooltip"
            role="tooltip"
            class="bg-popover text-popover-foreground pointer-events-none absolute bottom-full mb-2 scale-95 rounded-md border px-2 py-1 text-xs font-medium whitespace-nowrap opacity-0 shadow-md transition-[opacity,transform] group-hover/dock-item:scale-100 group-hover/dock-item:opacity-100 group-focus-within/dock-item:scale-100 group-focus-within/dock-item:opacity-100 motion-reduce:transition-none"
        >{{ $label }}</span>
    @endif

    <{{ $tag }}
        x-data="{
            scale: 1,
            update() {
                const r = this.$el.getBoundingClientRect();
                // Centre measured against the UNSCALED footprint: divide out the
                // current scale so the magnify can't feed back on itself.
                const center = r.left + (r.width / this.scale) / 2;
                this.scale = this.scaleFor(center);
            },
        }"
        x-init="update()"
        @mousemove.window="update()"
        @mouseleave.window="scale = 1"
        :style="`transform: scale(${scale}); transform-origin: bottom center;`"
        data-slot="dock-item-control"
        @if ($isLink) href="{{ $href }}" @else type="button" @endif
        @if ($label) aria-label="{{ $label }}" @endif
        @if ($active) aria-current="page" @endif
        {{ $attributes->twMerge('bg-muted text-foreground/80 hover:text-foreground focus-visible:ring-ring/50 flex size-11 items-center justify-center rounded-xl outline-none transition-transform duration-150 ease-out will-change-transform focus-visible:ring-[3px] motion-reduce:!transform-none motion-reduce:transition-none [&_svg]:size-6') }}
    >
        @if ($icon)
            <x-dynamic-component :component="'lucide-'.$icon" aria-hidden="true" />
        @endif
        {{ $slot }}
    </{{ $tag }}>

    {{-- Active indicator dot. --}}
    @if ($active)
        <span data-slot="dock-item-dot" class="bg-foreground/70 absolute -bottom-1 size-1 rounded-full" aria-hidden="true"></span>
    @endif
</div>
