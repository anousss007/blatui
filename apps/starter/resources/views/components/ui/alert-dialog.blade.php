@props(['open' => false])

<div data-slot="alert-dialog" x-data="{ open: @js((bool) $open) }" x-id="['blat-alert-dialog']" {{ $attributes }}>
    {{ $slot }}
</div>
