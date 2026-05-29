@props([
    'value' => null,
    'variant' => 'default',
    'size' => 'default',
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

    $group = "min-w-0 flex-1 shrink-0 rounded-none shadow-none first:rounded-l-md last:rounded-r-md focus:z-10 focus-visible:z-10 data-[variant=outline]:border-l-0 data-[variant=outline]:first:border-l";

    $classes = $base.' '.($variants[$variant] ?? $variants['default']).' '.($sizes[$size] ?? $sizes['default']).' '.$group;
@endphp

<button
    type="button"
    data-slot="toggle-group-item"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    @click="toggle(@js($value))"
    :data-state="isOn(@js($value)) ? 'on' : 'off'"
    :aria-pressed="isOn(@js($value))"
    @if ($disabled) disabled @endif
    {{ $attributes->twMerge($classes) }}
>
    {{ $slot }}
</button>
