@props(['direction' => 'bottom'])

<div
    data-slot="drawer"
    data-vaul-drawer-direction="{{ $direction }}"
    x-data="{ open: false, direction: @js($direction) }"
    x-id="['blat-drawer']"
    {{ $attributes }}
>
    {{ $slot }}
</div>
