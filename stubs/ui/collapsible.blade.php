@props(['open' => false])

<div data-slot="collapsible" x-data="{ open: @js((bool) $open) }" {{ $attributes }}>
    {{ $slot }}
</div>
