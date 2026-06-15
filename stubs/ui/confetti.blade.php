{{--
    Confetti — a celebratory particle burst.
      count    number of particles spawned per burst (default 80)
      spread   horizontal spread of the burst, in viewport-width-ish units (default 70)
      colors   optional array of CSS colours; falls back to a festive palette
    Usage: drop trigger content in the default slot (it becomes the clickable trigger
    that calls fire()), or omit it for a default "Celebrate 🎉" button. To fire from an
    external button, set x-ref / @click on this element and call $refs.<ref>.fire() —
    fire() is exposed on the Alpine component.
    Reduced-motion: under prefers-reduced-motion the burst does nothing (particles are
    purely decorative). A11y: the particle overlay is aria-hidden.
    RTL-safe: particles fan out symmetrically from the origin (no left/right keyword).
--}}
@props([
    'count' => 80,
    'spread' => 70,
    'colors' => null,
])

@once('blat-confetti')
    <style>
        @keyframes blat-confetti-fall {
            0% {
                opacity: 1;
                transform: translate3d(0, 0, 0) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translate3d(var(--blat-confetti-x), var(--blat-confetti-y), 0) rotate(var(--blat-confetti-rot));
            }
        }
        [data-slot="confetti"] .blat-confetti-piece {
            position: absolute;
            top: 0;
            left: 0;
            width: var(--blat-confetti-size, 8px);
            height: calc(var(--blat-confetti-size, 8px) * 0.4);
            border-radius: 1px;
            will-change: transform, opacity;
            animation: blat-confetti-fall var(--blat-confetti-dur, 1100ms) cubic-bezier(0.16, 1, 0.3, 1) var(--blat-confetti-delay, 0ms) forwards;
        }
        @media (prefers-reduced-motion: reduce) {
            [data-slot="confetti"] .blat-confetti-piece {
                animation: none;
                display: none;
            }
        }
    </style>
@endonce

@php
    $palette = is_array($colors) && count($colors)
        ? array_values($colors)
        : ['#6366f1', '#ec4899', '#f59e0b', '#22d3ee', '#34d399', '#a855f7', '#fb7185', '#fbbf24'];
@endphp

<span
    data-slot="confetti"
    x-data="{
        palette: @js($palette),
        count: @js((int) $count),
        spread: @js((float) $spread),
        reduced: false,
        init() {
            this.reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        },
        fire() {
            if (this.reduced) return;
            const overlay = this.$refs.overlay;
            if (! overlay) return;
            const rect = this.$el.getBoundingClientRect();
            // Burst origin: centre of the trigger.
            const originX = rect.left + rect.width / 2;
            const originY = rect.top + rect.height / 2;
            for (let i = 0; i < this.count; i++) {
                const piece = document.createElement('span');
                piece.className = 'blat-confetti-piece';
                // Fan out symmetrically; vary by index + a little randomness.
                const angle = (Math.PI * 2 * i) / this.count + (Math.random() - 0.5) * 0.6;
                const velocity = this.spread + Math.random() * this.spread;
                const vx = Math.cos(angle) * velocity;
                // Bias upward, then gravity pulls down for the fall.
                const vy = Math.sin(angle) * velocity - (this.spread * 0.8 + Math.random() * this.spread);
                const dur = 900 + Math.random() * 900;
                const delay = Math.random() * 120;
                const size = 6 + Math.random() * 8;
                const rot = (Math.random() * 720 - 360) + 'deg';
                const color = this.palette[i % this.palette.length];
                piece.style.left = originX + 'px';
                piece.style.top = originY + 'px';
                piece.style.background = color;
                piece.style.setProperty('--blat-confetti-x', vx.toFixed(2) + 'px');
                piece.style.setProperty('--blat-confetti-y', (vy + 320 + Math.random() * 160).toFixed(2) + 'px');
                piece.style.setProperty('--blat-confetti-rot', rot);
                piece.style.setProperty('--blat-confetti-dur', dur + 'ms');
                piece.style.setProperty('--blat-confetti-delay', delay + 'ms');
                piece.style.setProperty('--blat-confetti-size', size.toFixed(1) + 'px');
                if (Math.random() > 0.6) piece.style.borderRadius = '50%';
                overlay.appendChild(piece);
                setTimeout(() => piece.remove(), dur + delay + 80);
            }
        },
    }"
    {{ $attributes->twMerge('relative inline-flex') }}
>
    @if (trim($slot) !== '')
        <span @click="fire()" class="contents">{{ $slot }}</span>
    @else
        <x-ui.button type="button" @click="fire()">Celebrate &#127881;</x-ui.button>
    @endif

    {{-- Decorative particle overlay: fixed, full-viewport, never intercepts pointer events. --}}
    <span
        x-ref="overlay"
        aria-hidden="true"
        class="pointer-events-none fixed inset-0 z-[9999] overflow-hidden"
    ></span>
</span>
