@props(['value' => ''])

<div
    data-slot="menubar-radio-group"
    role="group"
    x-data="{ radioValue: @js((string) $value) }"
    {{ $attributes }}
>
    {{ $slot }}
</div>
