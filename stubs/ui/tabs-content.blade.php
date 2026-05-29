@props(['value' => null])

<div
    data-slot="tabs-content"
    role="tabpanel"
    x-show="tab === @js($value)"
    x-cloak
    {{ $attributes->twMerge('flex-1 outline-none') }}
>
    {{ $slot }}
</div>
