@props(['value' => ''])

<div
    data-slot="context-menu-radio-group"
    role="group"
    x-data="{ radioValue: @js((string) $value) }"
    {{ $attributes }}
>
    {{ $slot }}
</div>
