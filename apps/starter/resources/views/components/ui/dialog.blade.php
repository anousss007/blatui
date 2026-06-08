@props(['open' => false])

<div data-slot="dialog" x-data="{ open: @js((bool) $open) }" x-id="['blat-dialog']" {{ $attributes }}>
    {{ $slot }}
</div>
