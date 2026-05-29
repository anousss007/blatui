@props(['open' => false])

<div data-slot="dialog" x-data="{ open: @js((bool) $open) }" {{ $attributes }}>
    {{ $slot }}
</div>
