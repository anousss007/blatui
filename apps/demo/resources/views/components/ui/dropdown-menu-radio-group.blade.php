@props(['value' => ''])

<div
    data-slot="dropdown-menu-radio-group"
    role="group"
    x-data="{ radioValue: @js((string) $value) }"
    {{ $attributes }}
>
    {{ $slot }}
</div>
