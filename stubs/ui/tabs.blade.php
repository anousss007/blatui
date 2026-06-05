@props(['value' => null, 'orientation' => 'horizontal'])

<div
    data-slot="tabs"
    x-data="{ tab: @js($value), orientation: @js($orientation) }"
    x-id="['blat-tab', 'blat-tabpanel']"
    :data-orientation="orientation"
    {{ $attributes->twMerge('flex flex-col gap-2') }}
>
    {{ $slot }}
</div>
