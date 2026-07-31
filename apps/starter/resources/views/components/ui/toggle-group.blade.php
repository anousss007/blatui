@props([
    'type' => 'single',
    'value' => null,
    'variant' => 'default',
    'size' => 'default',
    'orientation' => 'horizontal',   // horizontal | vertical
])

@php
    // Livewire bridge — entangle Alpine state with a consumer's wire:model when present.
    // No-op (and stripped) without Livewire, so the component still works in plain Blade/Alpine.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) { $attributes = $attributes->whereDoesntStartWith('wire:model'); }
@endphp

<div
    data-slot="toggle-group"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    role="group"
    data-orientation="{{ $orientation }}"
    x-data="{
        type: @js($type),
        value: @if ($hasWire)@entangle($wireModel)@else @js($type === 'multiple' ? (array) ($value ?? []) : $value)@endif,
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
