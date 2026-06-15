{{--
    Aurora — an animated aurora / northern-lights gradient background with content overlaid.
      colors     array of CSS colours for the drifting blobs (overrides the default palette)
      blur       blur radius in px applied to the aurora layer (default 60 — higher = softer)
      speed      seconds for one full drift/rotate cycle (default 12)

    Technique: a relative, overflow-hidden container holds an aria-hidden decorative layer of
    several large radial-gradient blobs. The layer slowly drifts + rotates via a scoped keyframe
    and is heavily blurred so the colours bleed into a soft aurora. The slot content sits above
    on its own z-layer with padding.

    Reduced-motion: the drift is disabled under prefers-reduced-motion (colours stay put).
    A11y: the aurora layer is decorative (aria-hidden); only the slot content is read.
    Contrast: a faint dark scrim sits under the slot so white/light text reads (AA) on the
    default palette. Bring your own backdrop/scrim via the slot when overriding `colors`.
    RTL-safe: positioning is symmetric and uses no left/right keyword in the animation.
--}}
@props([
    'colors' => null,
    'blur' => 60,
    'speed' => 12,
])

@once('blat-aurora')
    <style>
        @keyframes blat-aurora-drift {
            0%   { transform: translate3d(-6%, -4%, 0) rotate(0deg) scale(1.15); }
            33%  { transform: translate3d(6%, 3%, 0) rotate(40deg) scale(1.3); }
            66%  { transform: translate3d(-4%, 5%, 0) rotate(-30deg) scale(1.2); }
            100% { transform: translate3d(-6%, -4%, 0) rotate(0deg) scale(1.15); }
        }
        @media (prefers-reduced-motion: reduce) {
            [data-slot="aurora"] .blat-aurora-layer {
                animation: none !important;
            }
        }
    </style>
@endonce

@php
    // Tasteful default aurora palette (cyan → violet → emerald → magenta-ish).
    $defaultColors = ['#22d3ee', '#6366f1', '#a855f7', '#34d399', '#ec4899'];

    $palette = is_array($colors) && count($colors) > 0
        ? array_values(array_filter($colors, fn ($c) => is_string($c) && $c !== ''))
        : $defaultColors;

    if (count($palette) === 0) {
        $palette = $defaultColors;
    }

    // Spread the blobs around the container; cycle the palette if there are more spots.
    $spots = [
        '20% 25%',
        '80% 20%',
        '65% 75%',
        '30% 80%',
        '50% 50%',
    ];

    $blobs = [];
    foreach ($spots as $i => $pos) {
        $color = $palette[$i % count($palette)];
        // Each blob is a soft radial gradient that fades to transparent.
        $blobs[] = "radial-gradient(40% 40% at {$pos}, {$color} 0%, transparent 70%)";
    }
    $blobBg = implode(', ', $blobs);

    $blurPx = (float) $blur . 'px';
    $speedS = (float) $speed . 's';
@endphp

<div
    data-slot="aurora"
    {{ $attributes->twMerge('relative isolate overflow-hidden rounded-xl bg-slate-950 text-white') }}
>
    {{-- Decorative aurora layer: oversized so the rotation never reveals empty corners. --}}
    <div
        class="blat-aurora-layer pointer-events-none absolute -inset-[40%] -z-10"
        style="background: {{ $blobBg }}; filter: blur({{ $blurPx }}) saturate(1.4); animation: blat-aurora-drift {{ $speedS }} ease-in-out infinite;"
        aria-hidden="true"
    ></div>

    {{-- Faint scrim so overlaid light text stays legible (AA) on the default palette. --}}
    <div class="pointer-events-none absolute inset-0 -z-10 bg-slate-950/30" aria-hidden="true"></div>

    {{-- Slot content sits above the aurora. --}}
    <div class="relative z-0 p-8">{{ $slot }}</div>
</div>
