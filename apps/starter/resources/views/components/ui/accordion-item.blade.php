@props(['value' => null])

<div
    data-slot="accordion-item"
    x-data="{ _v: @js($value ?? uniqid('acc-')) }"
    {{ $attributes->twMerge('border-b last:border-b-0') }}
>
    {{ $slot }}
</div>
