@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'bg-transparent',
        'icon' => "bg-muted text-foreground flex size-10 shrink-0 items-center justify-center rounded-lg [&_svg:not([class*='size-'])]:size-6",
    ];
@endphp

<div
    data-slot="empty-media"
    data-variant="{{ $variant }}"
    {{ $attributes->twMerge('mb-2 flex shrink-0 items-center justify-center '.($variants[$variant] ?? $variants['default'])) }}
>
    {{ $slot }}
</div>
