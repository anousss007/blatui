@props(['open' => false])

<div data-slot="collapsible" x-data="{ open: @js((bool) $open) }" x-id="['blat-collapsible']" {{ $attributes }}>
    {{ $slot }}
</div>
