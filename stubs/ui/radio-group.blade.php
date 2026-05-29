@props([
    'name' => null,
    'value' => null,
])

<div
    data-slot="radio-group"
    role="radiogroup"
    x-data="{ value: @js($value) }"
    {{ $attributes->twMerge('grid gap-3') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
    {{ $slot }}
</div>
