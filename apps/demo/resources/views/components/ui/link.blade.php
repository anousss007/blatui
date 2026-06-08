@props([
    'href' => '#',
    'variant' => 'default',
    'external' => false,
])

@php
    $base = 'inline underline-offset-4 rounded-xs transition-colors outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]';

    $variants = [
        'default' => 'text-primary underline decoration-primary/40 hover:decoration-primary',
        'muted' => 'text-muted-foreground underline decoration-muted-foreground/30 hover:text-foreground',
        'subtle' => 'text-current no-underline hover:underline',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['default']);
@endphp

<a
    href="{{ $href }}"
    data-slot="link"
    @if ($external) target="_blank" rel="noopener noreferrer" @endif
    {{ $attributes->twMerge($classes) }}
>{{ $slot }}@if ($external)<span class="sr-only"> (opens in new tab)</span>@endif</a>
