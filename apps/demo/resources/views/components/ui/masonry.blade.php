{{--
    Masonry — a Pinterest-style grid built on native CSS multi-column layout.
      columns  number of columns at the largest breakpoint (1-6, default 3). Lower counts are
               used progressively at smaller breakpoints so the grid reflows responsively.
      gap      spacing token (default '4'). Sets both the column-gap AND the bottom margin
               between items, so the horizontal and vertical rhythm stay equal.

    Just drop items straight into the slot — any direct child is automatically given
    `break-inside-avoid` (so a tile never splits across two columns) and a bottom margin
    (so items stack with even vertical spacing). No per-item classes needed.

    Note: CSS columns fill TOP-TO-BOTTOM, then left-to-right — so source order runs down
    column 1, then column 2, etc. This is the standard masonry trade-off and is RTL-safe
    (columns flow right-to-left automatically under `dir="rtl"`).
--}}
@props([
    'columns' => 3,
    'gap' => '4',
])

@php
    // Tailwind v4 only emits LITERAL class names, so every possible combination is spelled
    // out here and selected by lookup — never string-interpolated into a class attribute.

    // Responsive column ladders, keyed by the requested max column count.
    $columnClasses = [
        1 => 'columns-1',
        2 => 'columns-1 sm:columns-2',
        3 => 'columns-1 sm:columns-2 lg:columns-3',
        4 => 'columns-1 sm:columns-2 lg:columns-3 xl:columns-4',
        5 => 'columns-1 sm:columns-2 lg:columns-3 xl:columns-5',
        6 => 'columns-1 sm:columns-2 lg:columns-3 xl:columns-4 2xl:columns-6',
    ];
    $cols = $columnClasses[(int) $columns] ?? $columnClasses[3];

    // Gap token → matched column-gap utility + child bottom-margin utility. Both literal.
    $gapClasses = [
        '0' => 'gap-0 [&>*]:mb-0',
        '1' => 'gap-1 [&>*]:mb-1',
        '2' => 'gap-2 [&>*]:mb-2',
        '3' => 'gap-3 [&>*]:mb-3',
        '4' => 'gap-4 [&>*]:mb-4',
        '6' => 'gap-6 [&>*]:mb-6',
        '8' => 'gap-8 [&>*]:mb-8',
    ];
    $gapUtil = $gapClasses[(string) $gap] ?? $gapClasses['4'];

    $classes = trim($cols.' '.$gapUtil.' [&>*]:break-inside-avoid');
@endphp

<div data-slot="masonry" {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</div>
