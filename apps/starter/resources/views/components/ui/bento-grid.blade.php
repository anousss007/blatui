@props([
    'columns' => 3, // 2 | 3 | 4 — number of columns at the largest breakpoint
])

@php
    // Tailwind v4 only generates LITERAL class names, so every column count maps to a
    // fully spelled-out responsive class string here (never interpolated).
    $colClasses = [
        2 => 'sm:grid-cols-2',
        3 => 'sm:grid-cols-2 lg:grid-cols-3',
        4 => 'sm:grid-cols-2 lg:grid-cols-4',
    ];

    $cols = $colClasses[(int) $columns] ?? $colClasses[3];
@endphp

<div
    data-slot="bento-grid"
    {{ $attributes->twMerge('grid grid-cols-1 gap-4 auto-rows-[minmax(10rem,auto)] '.$cols) }}
>
    {{ $slot }}
</div>
