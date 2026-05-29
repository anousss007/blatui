@props(['open' => false])

<div data-slot="sheet" x-data="{ open: @js((bool) $open) }" {{ $attributes }}>
    {{ $slot }}
</div>
