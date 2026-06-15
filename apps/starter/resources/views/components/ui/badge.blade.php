@props([
    'variant' => 'default',
    'tone' => null,
    'size' => 'default',
    'href' => null,
])

@php
    $base = "inline-flex items-center justify-center rounded-md border font-medium w-fit whitespace-nowrap shrink-0 [&>svg]:size-3 gap-1 [&>svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden";

    // Padding / type scale. Literal strings for the Tailwind scanner.
    $sizes = [
        'sm' => 'px-1.5 py-px text-[0.625rem]',
        'default' => 'px-2 py-0.5 text-xs',
        'lg' => 'px-3 py-1 text-sm [&>svg]:size-3.5',
    ];
    $sizeCls = $sizes[$size] ?? $sizes['default'];

    // Brand variants (unchanged) — used when no `tone` is given.
    $variants = [
        'default' => 'border-transparent bg-primary text-primary-foreground [a&]:hover:bg-primary/90',
        'secondary' => 'border-transparent bg-secondary text-secondary-foreground [a&]:hover:bg-secondary/90',
        'destructive' => 'border-transparent bg-destructive text-white [a&]:hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:focus-visible:ring-destructive/40 dark:bg-destructive/60',
        'outline' => 'text-foreground [a&]:hover:bg-accent [a&]:hover:text-accent-foreground',
    ];

    // Semantic status tones. When `tone` is set, `variant` selects intensity:
    // soft (default) | solid | outline. Literal class strings (not interpolated) so
    // Tailwind's source scanner generates them.
    $tones = [
        'success' => [
            'soft' => 'border-transparent bg-success/10 text-success dark:bg-success/15',
            'solid' => 'border-transparent bg-success text-success-foreground',
            'outline' => 'text-success border-success/40',
        ],
        'warning' => [
            'soft' => 'border-transparent bg-warning/10 text-warning dark:bg-warning/15',
            'solid' => 'border-transparent bg-warning text-warning-foreground',
            'outline' => 'text-warning border-warning/40',
        ],
        'danger' => [
            'soft' => 'border-transparent bg-destructive/10 text-destructive dark:bg-destructive/15',
            'solid' => 'border-transparent bg-destructive text-destructive-foreground',
            'outline' => 'text-destructive border-destructive/40',
        ],
        'info' => [
            'soft' => 'border-transparent bg-info/10 text-info dark:bg-info/15',
            'solid' => 'border-transparent bg-info text-info-foreground',
            'outline' => 'text-info border-info/40',
        ],
        'neutral' => [
            'soft' => 'border-transparent bg-muted text-muted-foreground',
            'solid' => 'border-transparent bg-foreground/85 text-background',
            'outline' => 'text-muted-foreground border-border',
        ],
    ];

    if ($tone && isset($tones[$tone])) {
        $intensity = in_array($variant, ['soft', 'solid', 'outline'], true) ? $variant : 'soft';
        $classes = $base.' '.$sizeCls.' '.$tones[$tone][$intensity];
    } else {
        $classes = $base.' '.$sizeCls.' '.($variants[$variant] ?? $variants['default']);
    }
@endphp

@if ($href)
    <a href="{{ $href }}" data-slot="badge" {{ $attributes->twMerge($classes) }}>{{ $slot }}</a>
@else
    <span data-slot="badge" {{ $attributes->twMerge($classes) }}>{{ $slot }}</span>
@endif
