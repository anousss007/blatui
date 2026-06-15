@props([
    'layout' => 'horizontal',  // horizontal | vertical
    'bordered' => false,
])

@php
    // `bordered` wraps the rows in a card surface with dividers between them.
    // Otherwise rows simply stack with a comfortable vertical gap.
    $classes = $bordered
        ? 'bg-card text-card-foreground divide-border rounded-xl border divide-y'
        : 'flex flex-col gap-4';
@endphp

<dl data-slot="description-list" {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</dl>
