@props(['value' => null])

<div data-slot="tabs" x-data="{ tab: @js($value) }" {{ $attributes->twMerge('flex flex-col gap-2') }}>
    {{ $slot }}
</div>
