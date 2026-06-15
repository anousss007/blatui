{{--
    Dock — a macOS-style dock. A centered, floating rounded bar holding
    <x-ui.dock-item> tiles; the icon nearest the cursor magnifies, easing back
    to rest size with distance — the classic "fisheye" effect.

      magnify   the peak scale at the cursor (default 1.6).
      distance  the influence radius in px over which the magnify falls off
                to rest size (default 120).

    Implementation: the parent's inline Alpine holds `mouseX` (the cursor's
    clientX, or null when not hovering) and exposes a pure `scaleFor(centerX)`
    helper. Each dock-item measures its own horizontal centre and calls
    `scaleFor()` to derive its scale — so the whole effect is self-contained,
    no shared JS module needed. Alpine's scope chaining lets children read the
    parent x-data directly.

    A11y: rendered as <nav aria-label="Dock"> so the magnify bar is announced as
    a navigation landmark; each item is a focusable control with its own label +
    hover/focus tooltip + focus ring (see dock-item).
    Reduced-motion: when the user prefers reduced motion, `scaleFor()` always
    returns 1, so tiles stay at rest size (no magnify, no transition).
    RTL-safe: positions are absolute pixel coordinates (getBoundingClientRect /
    clientX) with no left/right keywords, so the effect is identical in LTR/RTL.
--}}
@props([
    'magnify' => 1.6,
    'distance' => 120,
])

@php
    $peak = (float) $magnify;
    $falloff = (int) $distance;
@endphp

<nav
    data-slot="dock"
    aria-label="Dock"
    x-data="{
        mouseX: null,
        peak: @js($peak),
        falloff: @js($falloff),
        reduced: false,
        init() {
            const mq = window.matchMedia('(prefers-reduced-motion: reduce)');
            this.reduced = mq.matches;
            mq.addEventListener?.('change', e => { this.reduced = e.matches; });
        },
        // Pure scale for a tile whose horizontal centre is `centerX` (px, viewport).
        // 1 at rest / out of range, easing up to `peak` as the cursor nears.
        scaleFor(centerX) {
            if (this.reduced || this.mouseX === null) return 1;
            const d = Math.abs(this.mouseX - centerX);
            if (d >= this.falloff) return 1;
            // Cosine ease: smooth 1 → peak as distance 1 → 0.
            const t = (Math.cos((d / this.falloff) * Math.PI) + 1) / 2;
            return 1 + (this.peak - 1) * t;
        },
    }"
    @mousemove="mouseX = $event.clientX"
    @mouseleave="mouseX = null"
    {{ $attributes->twMerge('bg-card/80 supports-[backdrop-filter]:bg-card/60 mx-auto flex w-fit items-end gap-2 rounded-2xl border px-3 py-2 shadow-lg backdrop-blur') }}
>
    {{ $slot }}
</nav>
