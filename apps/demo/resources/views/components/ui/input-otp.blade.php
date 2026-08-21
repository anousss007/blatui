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

    // Livewire bridge — bind Alpine state to a consumer's wire:model when present. The property
    // path travels as a data attribute rather than baked into x-data (which Alpine evaluates once),
    // so a morph that re-points or re-mounts the component is followed. $blatModel reads and writes
    // the Livewire property directly; without Livewire it just holds the value locally, so the
    // component still works in plain Blade/Alpine. See the bridge in blatui-core.js.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) {
        $attributes = $attributes->whereDoesntStartWith('wire:model')->merge(array_filter([
            'data-blat-model' => $wireModel->value(),
            'data-blat-model-live' => $wireModel->hasModifier('live') ? '1' : null,
        ]));
    }
@endphp

<div
    data-slot="input-otp"
    x-data="{
        _model: $blatModel(@js((string) $value)),
        get value() { return this._model.value; },
        set value(v) { this._model.value = v; },
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
