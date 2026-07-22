@props([
    'direction' => 'col',
    'gap' => '4',
    'align' => null,
    'justify' => null,
    'wrap' => false,
])

@php
    $directions = [
        'col' => 'flex-col',
        'row' => 'flex-row',
    ];

    $gaps = [
        '0' => 'gap-0',
        '1' => 'gap-1',
        '2' => 'gap-2',
        '3' => 'gap-3',
        '4' => 'gap-4',
        '5' => 'gap-5',
        '6' => 'gap-6',
        '8' => 'gap-8',
        '10' => 'gap-10',
        '12' => 'gap-12',
    ];

    $aligns = [
        'start' => 'items-start',
        'center' => 'items-center',
        'end' => 'items-end',
        'stretch' => 'items-stretch',
        'baseline' => 'items-baseline',
    ];

    $justifies = [
        'start' => 'justify-start',
        'center' => 'justify-center',
        'end' => 'justify-end',
        'between' => 'justify-between',
        'around' => 'justify-around',
        'evenly' => 'justify-evenly',
    ];

    $classes = collect([
        'flex',
        $directions[$direction] ?? $directions['col'],
        $gaps[(string) $gap] ?? $gaps['4'],
        $align ? ($aligns[$align] ?? '') : '',
        $justify ? ($justifies[$justify] ?? '') : '',
        $wrap ? 'flex-wrap' : '',
    ])->filter()->implode(' ');
@endphp

<div
    data-slot="stack"
    {{ $attributes->twMerge($classes) }}
>
    {{ $slot }}
</div>
