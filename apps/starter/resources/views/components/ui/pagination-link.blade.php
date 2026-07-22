@props([
    'href' => '#',
    'isActive' => false,
    'size' => 'icon',
])

@php
    $base = "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]";
    $variant = $isActive
        ? 'border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50'
        : 'hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50';
    $sizes = [
        'default' => 'h-9 px-4 py-2 has-[>svg]:px-3',
        'sm' => 'h-8 rounded-md gap-1.5 px-3 has-[>svg]:px-2.5',
        'lg' => 'h-10 rounded-md px-6 has-[>svg]:px-4',
        'icon' => 'size-9',
    ];
    $classes = $base.' '.$variant.' '.($sizes[$size] ?? $sizes['icon']);
@endphp

<a
    href="{{ $href }}"
    data-slot="pagination-link"
    @if ($isActive) aria-current="page" data-active="true" @endif
    {{ $attributes->twMerge($classes) }}
>{{ $slot }}</a>
