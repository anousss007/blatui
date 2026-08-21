@props([
    'type' => 'single',
    'value' => null,
    'variant' => 'default',
    'size' => 'default',
    'orientation' => 'horizontal',   // horizontal | vertical
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
    data-slot="toggle-group"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    role="group"
    data-orientation="{{ $orientation }}"
    x-data="{
        type: @js($type),
        _model: $blatModel(@js($type === 'multiple' ? (array) ($value ?? []) : $value)),
        get value() { return this._model.value; },
        set value(v) { this._model.value = v; },
        rovingValue: null,
        toggle(v) {
            if (this.type === 'multiple') {
                this.value = this.value.includes(v) ? this.value.filter(x => x !== v) : [...this.value, v];
            } else {
                this.value = this.value === v ? null : v;
            }
        },
        isOn(v) {
            return this.type === 'multiple' ? this.value.includes(v) : this.value === v;
        },
    }"
    x-init="$nextTick(() => { const f = $el.querySelector('[data-slot=toggle-group-item]:not([disabled])'); rovingValue = f?.getAttribute('data-value') ?? null })"
    @keydown="if (['ArrowLeft','ArrowRight','ArrowUp','ArrowDown','Home','End'].includes($event.key)) { $blatNav($event, { selector: '[data-slot=toggle-group-item]', orientation: 'both' }); }"
    {{ $attributes->twMerge('group/toggle-group flex w-fit items-center rounded-md data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-stretch data-[variant=outline]:shadow-xs') }}
>
    {{ $slot }}
</div>
