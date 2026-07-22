{{--
    Gradient Text — renders its slot as real, accessible text painted with a CSS
    gradient (background-clip: text). Optionally animates a shimmer by sliding the
    background-position.

      from / via / to   gradient colour stops (hex / oklch / any CSS colour or
                        a Tailwind colour value). Override the preset / default.
      preset            named gradient: brand (default) | sunset | ocean | candy |
                        gold | aurora | flamingo | mint
      animate           when true, animate the background-position (shimmer)
      as                rendered tag (span by default so it composes inside headings)

    Reduced-motion: the shimmer is disabled under prefers-reduced-motion.
    A11y: the text is real DOM text; only the painting is decorative.
    RTL-safe: the gradient flows along the inline axis via a side-agnostic angle.
--}}
@props([
    'from' => null,
    'via' => null,
    'to' => null,
    'preset' => null,
    'animate' => false,
    'as' => 'span',
])

@once('blat-gradient-text')
    <style>
        @keyframes blat-gradient-text-shimmer {
            to { background-position: 200% center; }
        }
        @media (prefers-reduced-motion: reduce) {
            [data-slot="gradient-text"][data-animate="true"] { animation: none !important; }
        }
    </style>
@endonce

@php
    // Tasteful, brand-ish gradients. Each entry is [from, via (nullable), to].
    $presets = [
        'brand'    => ['#6366f1', '#a855f7', '#ec4899'],
        'sunset'   => ['#f97316', '#ef4444', '#ec4899'],
        'ocean'    => ['#06b6d4', '#3b82f6', '#6366f1'],
        'candy'    => ['#ec4899', '#d946ef', '#8b5cf6'],
        'gold'     => ['#f59e0b', '#eab308', '#fbbf24'],
        'aurora'   => ['#22d3ee', '#a78bfa', '#34d399'],
        'flamingo' => ['#fb7185', '#f472b6', '#c084fc'],
        'mint'     => ['#34d399', '#10b981', '#059669'],
    ];

    // Explicit from/to wins; otherwise fall back to the chosen (or default) preset.
    if ($from !== null || $to !== null) {
        $cFrom = $from ?? '#6366f1';
        $cVia  = $via;
        $cTo   = $to ?? $cFrom;
    } else {
        [$cFrom, $cVia, $cTo] = $presets[$preset] ?? $presets['brand'];
        // Allow `via` to still override the preset's middle stop.
        if ($via !== null) {
            $cVia = $via;
        }
    }

    // Build the stop list (skip an empty middle stop).
    $stops = $cVia !== null && $cVia !== ''
        ? "{$cFrom}, {$cVia}, {$cTo}"
        : "{$cFrom}, {$cTo}";

    // 90deg flows along the inline axis → RTL-safe (no left/right keyword).
    $gradient = "linear-gradient(90deg, {$stops})";

    $animate = filter_var($animate, FILTER_VALIDATE_BOOLEAN);

    $style = "background-image: {$gradient};"
        . " background-size: 200% auto;"
        . " background-position: " . ($animate ? '0% center' : '50% center') . ";"
        . " -webkit-background-clip: text; background-clip: text;"
        . " color: transparent; -webkit-text-fill-color: transparent;";

    if ($animate) {
        $style .= " animation: blat-gradient-text-shimmer 4s linear infinite;";
    }
@endphp

<{{ $as }}
    data-slot="gradient-text"
    @if ($preset) data-preset="{{ $preset }}" @endif
    data-animate="{{ $animate ? 'true' : 'false' }}"
    style="{{ $style }}"
    {{ $attributes->twMerge('inline-block bg-clip-text text-transparent') }}
>{{ $slot }}</{{ $as }}>
