@props(['open' => false])

<div data-slot="alert-dialog" x-data="{ open: @js((bool) $open) }" {{ $attributes }}>
    {{ $slot }}
</div>
