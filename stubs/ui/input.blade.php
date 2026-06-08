@props(['type' => 'text', 'size' => 'default'])

@php
    $base = "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex w-full min-w-0 rounded-md border bg-transparent shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:border-0 file:bg-transparent file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive";

    $sizes = [
        'sm' => 'h-8 px-2.5 py-1 text-sm file:h-6 file:text-xs',
        'default' => 'h-9 px-3 py-1 text-base md:text-sm file:h-7 file:text-sm',
        'lg' => 'h-10 px-4 py-2 text-base file:h-8 file:text-sm',
    ];

    $classes = $base.' '.($sizes[$size] ?? $sizes['default']);
@endphp

<input
    type="{{ $type }}"
    data-slot="input"
    data-size="{{ $size }}"
    {{ $attributes->twMerge($classes) }}
/>
