@props(['variant' => 'default'])

@php
    $variants = [
        'default' => "bg-transparent",
        'icon' => "bg-muted size-8 border rounded-sm [&_svg:not([class*='size-'])]:size-4",
        'image' => "size-10 rounded-sm overflow-hidden [&_img]:size-full [&_img]:object-cover",
    ];
@endphp

<div
    data-slot="item-media"
    data-variant="{{ $variant }}"
    {{ $attributes->twMerge("flex shrink-0 items-center justify-center gap-2 group-has-[[data-slot=item-description]]/item:self-start group-has-[[data-slot=item-description]]/item:translate-y-0.5 [&_svg]:pointer-events-none ".($variants[$variant] ?? $variants['default'])) }}
>
    {{ $slot }}
</div>
