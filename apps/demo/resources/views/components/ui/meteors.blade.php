{{--
    Meteors — animated falling meteor / shooting-star streaks behind content.
      count   how many meteor streaks to render (default 20)
      color   CSS colour (or Tailwind utility via the slot) for the meteor head + trail;
              defaults to the foreground colour at low opacity so it suits light & dark.

    Technique: a relative, overflow-hidden container holds an aria-hidden decorative layer of
    N meteor spans. Each meteor is a tiny round head with a thin gradient trail; it starts off
    the top-right, is animated diagonally down-left, and fades out — with a per-meteor inline
    left position, delay and duration so the streaks are spread out and never march in lockstep.
    The slot content sits above on its own z-layer.

    Reduced-motion: the fall is disabled under prefers-reduced-motion (meteors stay hidden/static).
    A11y: the meteor layer is purely decorative (aria-hidden); only the slot content is read.
    RTL-safe: the meteor layer is wrapped in `dir="ltr"` so the diagonal direction is constant
    regardless of document direction; slot content keeps the document's own direction.
--}}
@props([
    'count' => 20,
    'color' => null,
])

@once('blat-meteors')
    <style>
        @keyframes blat-meteors-fall {
            0% {
                transform: translate3d(0, 0, 0) rotate(var(--blat-meteors-angle, 215deg));
                opacity: 1;
            }
            70% {
                opacity: 1;
            }
            100% {
                /* Travel far enough to always clear the container on the diagonal. */
                transform: translate3d(-120vw, 120vh, 0) rotate(var(--blat-meteors-angle, 215deg));
                opacity: 0;
            }
        }
        @media (prefers-reduced-motion: reduce) {
            [data-slot="meteors"] .blat-meteors-layer {
                display: none !important;
            }
        }
    </style>
@endonce

@php
    // Clamp the count to something sane so the layer can never explode the DOM.
    $n = max(1, min(100, (int) $count));

    // Default to the theme foreground at low opacity → reads on both light & dark chrome.
    // A caller-supplied colour is any valid CSS colour string.
    $head = ($color !== null && $color !== '')
        ? $color
        : 'color-mix(in oklab, var(--foreground) 40%, transparent)';

    // Trail: fade from the head colour to transparent.
    $trail = "linear-gradient(90deg, {$head}, transparent)";

    // Pre-compute deterministic-ish but varied per-meteor values so the SSR output is stable.
    $meteors = [];
    for ($i = 0; $i < $n; $i++) {
        // Spread horizontally a bit beyond the right edge so streaks enter from off-canvas too.
        $left = -20 + ($i * (140 / $n)) + (($i * 37) % 23);   // %
        $delay = round((($i * 53) % 100) / 100 * 8, 2);        // 0–8s
        $duration = round(4 + (($i * 29) % 60) / 10, 2);       // 4–10s
        $size = 1 + (($i * 17) % 2);                           // 1–2px head
        $meteors[] = compact('left', 'delay', 'duration', 'size');
    }
@endphp

<div
    data-slot="meteors"
    {{ $attributes->twMerge('relative isolate overflow-hidden') }}
>
    {{-- Decorative meteor layer — purely visual, never announced. --}}
    <div class="blat-meteors-layer pointer-events-none absolute inset-0 -z-10" aria-hidden="true" dir="ltr">
        @foreach ($meteors as $m)
            <span
                class="absolute top-0 rounded-full"
                style="
                    left: {{ $m['left'] }}%;
                    width: {{ $m['size'] }}px;
                    height: {{ $m['size'] }}px;
                    background: {{ $head }};
                    box-shadow: 0 0 0 1px {{ $head }};
                    animation: blat-meteors-fall {{ $m['duration'] }}s linear {{ $m['delay'] }}s infinite;
                "
            >
                {{-- Trailing gradient line behind the head. --}}
                <span
                    class="absolute top-1/2 -translate-y-1/2 rounded-full"
                    style="
                        right: 0;
                        width: 3rem;
                        height: 1px;
                        background: {{ $trail }};
                    "
                ></span>
            </span>
        @endforeach
    </div>

    {{-- Slot content sits above the meteor layer. --}}
    <div class="relative z-0">{{ $slot }}</div>
</div>
