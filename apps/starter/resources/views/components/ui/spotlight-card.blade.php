{{--
    Spotlight Card — a card with a radial spotlight that follows the cursor on
    hover. The card itself is a normal token-styled surface (bg-card, border,
    rounded, padded); a decorative overlay paints a soft radial glow centred on
    the pointer and fades in on hover.

      color   the glow colour (any CSS colour). Defaults to a subtle neutral
              glow that reads well in BOTH light and dark themes (a foreground
              token mixed down to a low alpha via color-mix).
      size    the spotlight radius in pixels (the gradient's solid-to-transparent
              falloff). Default 350.

    Implementation: inline Alpine tracks the pointer with @mousemove and writes
    the position to --x / --y CSS custom properties on the root element. The
    overlay's radial-gradient is anchored at `circle at var(--x) var(--y)` and
    its opacity is toggled by a `hover` flag. Everything is self-contained.

    A11y: the spotlight overlay is purely decorative → aria-hidden. The card
    content (slot) sits above it on its own stacking context.
    RTL-safe: positions are pixel coordinates relative to the element, with no
    left/right keywords, so the effect is identical in LTR and RTL.
    Reduced-motion: the glow still appears but its fade is instantaneous.
--}}
@props([
    'color' => null,
    'size' => 350,
])

@php
    // A subtle neutral glow that works in light AND dark: take the theme's
    // foreground token and mix it down to a low alpha so it reads as a soft
    // highlight on either surface. Callers can pass any CSS colour to override.
    $glow = $color ?? 'color-mix(in oklab, var(--foreground) 14%, transparent)';

    // Falloff distance for the radial gradient (solid centre → transparent edge).
    $radius = (int) $size;
@endphp

<div
    data-slot="spotlight-card"
    x-data="{
        hover: false,
        track(e) {
            const r = this.$el.getBoundingClientRect();
            this.$el.style.setProperty('--x', (e.clientX - r.left) + 'px');
            this.$el.style.setProperty('--y', (e.clientY - r.top) + 'px');
        },
    }"
    @mousemove="track($event)"
    @mouseenter="hover = true"
    @mouseleave="hover = false"
    {{ $attributes->twMerge('bg-card text-card-foreground relative overflow-hidden rounded-xl border p-6 shadow-sm') }}
>
    {{-- Decorative spotlight overlay — follows the cursor, fades in on hover. --}}
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 rounded-[inherit] transition-opacity duration-300 motion-reduce:transition-none"
        :style="{ opacity: hover ? 1 : 0 }"
        style="background: radial-gradient(circle {{ $radius }}px at var(--x, 50%) var(--y, 50%), {{ $glow }}, transparent 80%);"
    ></div>

    {{-- Card content sits above the overlay on its own stacking context. --}}
    <div class="relative z-10">
        {{ $slot }}
    </div>
</div>
