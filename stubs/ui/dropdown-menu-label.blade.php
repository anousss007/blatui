@props(['inset' => false])

<div
    data-slot="dropdown-menu-label"
    @if ($inset) data-inset @endif
    {{ $attributes->twMerge('px-2 py-1.5 text-sm font-medium data-[inset]:pl-8') }}
>{{ $slot }}</div>
