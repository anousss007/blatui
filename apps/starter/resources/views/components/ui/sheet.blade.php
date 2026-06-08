@props(['open' => false])

<div data-slot="sheet" x-data="{ open: @js((bool) $open) }" x-id="['blat-sheet']" {{ $attributes }}>
    {{ $slot }}
</div>
