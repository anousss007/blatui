@props([
    'name' => null,
    'value' => '',
])

<div
    data-slot="select"
    x-data="blatSelect({ value: @js((string) $value) })"
    x-id="['blat-listbox']"
    {{ $attributes->twMerge('relative') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
    {{ $slot }}
</div>
