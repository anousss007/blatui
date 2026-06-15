@props(['variant' => 'default'])

@php
    $variants = [
        // Simple padded box — the dominant use case. Put any content inside directly.
        'default' => 'bg-card text-card-foreground rounded-xl border p-6 shadow-sm',
        // Sectioned layout for card-header / card-content / card-footer. Those parts each
        // supply their own px-6, so this adds py-6 only (never px) to avoid double padding.
        'sectioned' => 'bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm',
    ];

    $classes = $variants[$variant] ?? $variants['default'];
@endphp

<div data-slot="card" {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</div>
