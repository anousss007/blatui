@props(['value' => null])

<div
    data-slot="accordion-item"
    x-data="{ _v: @js($value ?? uniqid('acc-')) }"
    :data-state="isOpen(_v) ? 'open' : 'closed'"
    {{ $attributes->twMerge('border-b last:border-b-0') }}
>
    {{ $slot }}
</div>
