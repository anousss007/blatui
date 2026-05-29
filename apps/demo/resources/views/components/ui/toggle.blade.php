@props([
    'variant' => 'default',
    'size' => 'default',
    'pressed' => false,
    'disabled' => false,
])

@php
    $base = "inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium hover:bg-muted hover:text-muted-foreground disabled:pointer-events-none disabled:opacity-50 data-[state=on]:bg-accent data-[state=on]:text-accent-foreground [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:shrink-0 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] outline-none transition-[color,box-shadow] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive whitespace-nowrap";

    $variants = [
        'default' => 'bg-transparent',
        'outline' => 'border border-input bg-transparent shadow-xs hover:bg-accent hover:text-accent-foreground',
    ];

    $sizes = [
        'default' => 'h-9 px-2 min-w-9',
        'sm' => 'h-8 px-1.5 min-w-8',
        'lg' => 'h-10 px-2.5 min-w-10',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['default']).' '.($sizes[$size] ?? $sizes['default']);
@endphp

<button
    type="button"
    x-data="{ pressed: @js((bool) $pressed) }"
    @click="pressed = !pressed"
    :data-state="pressed ? 'on' : 'off'"
    :aria-pressed="pressed"
    @if ($disabled) disabled @endif
    data-slot="toggle"
    {{ $attributes->twMerge($classes) }}
>
    {{ $slot }}
</button>
