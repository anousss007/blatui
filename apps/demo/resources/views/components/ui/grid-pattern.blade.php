@props([
    'gap' => 24,        // cell size in px (the grid spacing)
    'lineWidth' => 1,   // grid line thickness in px
    'mask' => false,    // radial fade so the grid dissolves toward the edges
])

@php
    $g = (float) $gap;
    $lw = (float) $lineWidth;

    // Two stacked gradients (vertical + horizontal lines) tiled at the cell size.
    // currentColor lets the line colour follow text-foreground/10, so it themes in
    // light and dark with no extra props.
    $bgImage = "linear-gradient(to right, currentColor {$lw}px, transparent {$lw}px),"
        ." linear-gradient(to bottom, currentColor {$lw}px, transparent {$lw}px)";
    $bgSize = "{$g}px {$g}px";

    $style = "background-image: {$bgImage}; background-size: {$bgSize};";

    if ($mask) {
        // Fade the grid out toward the edges with a radial alpha mask.
        $maskImage = 'radial-gradient(ellipse at center, #000 0%, transparent 75%)';
        $style .= " -webkit-mask-image: {$maskImage}; mask-image: {$maskImage};";
    }

    $userStyle = (string) $attributes->get('style', '');
    $style = trim($style.($userStyle ? ' '.$userStyle : ''));
    $attributes = $attributes->except('style');
@endphp

<div
    data-slot="grid-pattern"
    aria-hidden="true"
    style="{{ $style }}"
    {{ $attributes->twMerge('text-foreground/10 pointer-events-none absolute inset-0 -z-10') }}
></div>
