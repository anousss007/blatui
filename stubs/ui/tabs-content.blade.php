@props(['value' => null])

<div
    data-slot="tabs-content"
    role="tabpanel"
    tabindex="0"
    :id="$id('blat-tabpanel', @js($value))"
    :aria-labelledby="$id('blat-tab', @js($value))"
    x-show="tab === @js($value)"
    x-cloak
    {{ $attributes->twMerge('flex-1 outline-none') }}
>
    {{ $slot }}
</div>
