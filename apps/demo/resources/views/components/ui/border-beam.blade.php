{{--
    Border Beam — a card whose border has a light beam continuously travelling around it.
      duration  seconds for one full revolution of the beam (default 6)
      color     beam highlight color; defaults to the primary token (e.g. "#6366f1" or "var(--color-ring)")
      size      thickness of the border / beam ring in px (default 2)
    Technique: a rounded overlay paints a rotating `conic-gradient` and is masked to a ring
    via two stacked `mask` layers (border-box minus padding-box), so only the border shows.
    The overlay is decorative (aria-hidden) and pauses under prefers-reduced-motion.
    The slot content sits on bg-card above the beam, so the ring peeks out around it.
--}}
@props([
    'duration' => 6,
    'color' => null,
    'size' => 2,
])

@php
    $beam = $color ?: 'var(--color-primary)';
    $thickness = (int) $size . 'px';
    $dur = (float) $duration . 's';
@endphp

@once('blat-border-beam')
    <style>
        @keyframes blat-border-beam-spin {
            to { transform: rotate(1turn); }
        }
        [data-slot="border-beam"] .blat-border-beam-ring::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: var(--blat-beam-size, 2px);
            background: conic-gradient(
                from 0deg,
                transparent 0deg,
                transparent 300deg,
                var(--blat-beam-color, currentColor) 345deg,
                #fff 360deg
            );
            -webkit-mask:
                linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask:
                linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);
            mask-composite: exclude;
            animation: blat-border-beam-spin var(--blat-beam-duration, 6s) linear infinite;
        }
        @media (prefers-reduced-motion: reduce) {
            [data-slot="border-beam"] .blat-border-beam-ring::before {
                animation: none;
            }
        }
    </style>
@endonce

<div
    data-slot="border-beam"
    {{ $attributes->twMerge('bg-card text-card-foreground relative overflow-hidden rounded-xl border p-6 shadow-sm') }}
>
    <span
        class="blat-border-beam-ring pointer-events-none absolute inset-0 rounded-[inherit]"
        style="--blat-beam-size: {{ $thickness }}; --blat-beam-color: {{ $beam }}; --blat-beam-duration: {{ $dur }};"
        aria-hidden="true"
    ></span>

    <div class="relative">{{ $slot }}</div>
</div>
