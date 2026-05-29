@props([
    'size' => 'xs',
    'variant' => 'ghost',
    'type' => 'button',
])

@php
    $base = "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]";
    $variants = [
        'ghost' => 'hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50',
        'outline' => 'border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50',
        'default' => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
    ];
    $sizes = [
        'xs' => 'h-6 gap-1 px-2 rounded-[calc(var(--radius)-5px)] has-[>svg]:px-2 text-xs',
        'sm' => 'h-8 gap-1.5 px-2.5 has-[>svg]:px-2.5',
        'icon-xs' => 'size-6 rounded-[calc(var(--radius)-5px)] p-0 has-[>svg]:p-0',
        'icon-sm' => 'size-8 p-0 has-[>svg]:p-0',
    ];
    $classes = $base.' '.($variants[$variant] ?? $variants['ghost']).' '.($sizes[$size] ?? $sizes['xs']);
@endphp

<button type="{{ $type }}" data-slot="input-group-button" {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</button>
