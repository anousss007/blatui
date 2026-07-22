@props([
    'name' => null,
    'maxlength' => 6,
    'value' => '',
    'disabled' => false,
    'alphanumeric' => false,
    'ariaLabel' => 'One-time password',
])

@php
    $inputmode = $alphanumeric ? 'text' : 'numeric';
    $pattern = $alphanumeric ? '[a-zA-Z0-9]*' : '[0-9]*';

    // Livewire bridge — entangle Alpine state with a consumer's wire:model when present.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) { $attributes = $attributes->whereDoesntStartWith('wire:model'); }
@endphp

<div
    data-slot="input-otp"
    x-data="{
        value: @if ($hasWire)@entangle($wireModel)@else @js((string) $value)@endif,
        max: {{ $maxlength }},
        focused: false,
        get active() { return this.focused ? Math.min(this.value.length, this.max - 1) : -1 }
    }"
    {{ $attributes->twMerge('relative flex items-center gap-2 has-disabled:opacity-50') }}
>
    <input
        x-ref="input"
        x-model="value"
        :maxlength="max"
        @focus="focused = true"
        @blur="focused = false"
        inputmode="{{ $inputmode }}"
        autocomplete="one-time-code"
        pattern="{{ $pattern }}"
        aria-label="{{ $ariaLabel }}"
        @if ($name) name="{{ $name }}" @endif
        @if ($disabled) disabled @endif
        class="absolute inset-0 z-10 h-full w-full cursor-default opacity-0 disabled:cursor-not-allowed"
    >
    {{ $slot }}
</div>
