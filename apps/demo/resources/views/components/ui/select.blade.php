@props([
    'name' => null,
    'value' => '',
])

<div
    data-slot="select"
    x-data="{ open: false, value: @js((string) $value), label: '' }"
    {{ $attributes->twMerge('relative') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
    {{ $slot }}
</div>
