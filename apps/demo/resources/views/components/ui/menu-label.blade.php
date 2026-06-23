@props([
    'dataSlot' => 'menu-label',
    // context-menu prefixes the canonical classes with `text-foreground`; dropdown/menubar do not.
    'classes' => 'px-2 py-1.5 text-sm font-medium data-[inset]:pl-8',
    'inset' => false,
])

<div
    data-slot="{{ $dataSlot }}"
    role="presentation"
    @if ($inset) data-inset @endif
    {{ $attributes->twMerge($classes) }}
>{{ $slot }}</div>
