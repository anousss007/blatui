{{--
    Dot Pattern — a decorative dotted background layer.

      size   diameter of each dot in px (default 1)
      gap    spacing between dots in px (default 16)
      mask   when true, radially fades the dots to transparent toward the edges
             so the grid is densest in the centre (default false)

    The element is absolutely positioned (inset-0) and fills its nearest
    positioned ancestor, so usage = drop it inside a `relative` container; the
    real content then sits above it. The grid is painted with a CSS
    radial-gradient whose colour is `currentColor`, and the root carries
    `text-foreground/15` so the dots pick up the theme's foreground token at a
    low opacity — readable in BOTH light and dark with no per-theme overrides.

    A11y: purely decorative → aria-hidden. RTL-safe: the pattern is symmetric
    and uses no left/right keywords, so it renders identically in LTR and RTL.
--}}
@props([
    'size' => 1,
    'gap' => 16,
    'mask' => false,
])

@php
    $dot = (float) $size;
    $cell = (float) $gap;

    // Edge fade: a centred radial mask that goes opaque → transparent so the
    // dot grid dissolves toward the container's edges.
    $maskCss = $mask
        ? 'mask-image: radial-gradient(ellipse at center, #000 40%, transparent 75%); -webkit-mask-image: radial-gradient(ellipse at center, #000 40%, transparent 75%);'
        : '';
@endphp

<div
    data-slot="dot-pattern"
    aria-hidden="true"
    {{ $attributes->twMerge('pointer-events-none absolute inset-0 text-foreground/15') }}
    style="
        background-image: radial-gradient(currentColor {{ $dot }}px, transparent {{ $dot }}px);
        background-size: {{ $cell }}px {{ $cell }}px;
        background-position: 0 0;
        {{ $maskCss }}
    "
></div>
