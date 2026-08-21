@props([
    'name' => null,
    'value' => null,
])

@php
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
    data-slot="radio-group"
    role="radiogroup"
    x-data="{ _model: $blatModel(@js($value)), get value() { return this._model.value; }, set value(v) { this._model.value = v; }, rovingValue: @js($value) }"
    x-init="$nextTick(() => { if (rovingValue === null) { const f = $el.querySelector('[role=radio]:not([disabled])'); rovingValue = f?.getAttribute('data-value') ?? null } })"
    @keydown="if (['ArrowUp','ArrowDown','ArrowLeft','ArrowRight','Home','End'].includes($event.key)) { $blatNav($event, { selector: '[role=radio]', orientation: 'both' }); const v = document.activeElement?.getAttribute('data-value'); if (v != null) { value = v; rovingValue = v; } }"
    {{ $attributes->twMerge('grid gap-3') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
    {{ $slot }}
</div>
