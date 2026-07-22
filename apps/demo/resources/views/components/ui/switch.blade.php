@props([
    'id' => null,
    'name' => null,
    'value' => 'on',
    'checked' => false,
    'disabled' => false,
    'size' => 'default',   // sm | default | lg
])

@php
    // Livewire bridge — entangle Alpine state with a consumer's wire:model when present.
    // No-op (and stripped) without Livewire, so the component still works in plain Blade/Alpine.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) { $attributes = $attributes->whereDoesntStartWith('wire:model'); }
@endphp

@php
    $track = match ($size) {
        'sm' => 'h-4 w-7',
        'lg' => 'h-6 w-10',
        default => 'h-[1.15rem] w-8',
    };
    $thumb = match ($size) {
        'sm' => 'size-3.5',
        'lg' => 'size-5',
        default => 'size-4',
    };
@endphp

<button
    type="button"
    role="switch"
    @if ($id) id="{{ $id }}" @endif
    x-data="{ checked: @if ($hasWire)@entangle($wireModel)@else @js((bool) $checked)@endif }"
    :data-state="checked ? 'checked' : 'unchecked'"
    :aria-checked="checked"
    @click="checked = !checked"
    @if ($disabled) disabled @endif
    data-slot="switch"
    {{ $attributes->twMerge("peer data-[state=checked]:bg-primary data-[state=unchecked]:bg-input focus-visible:border-ring focus-visible:ring-ring/50 dark:data-[state=unchecked]:bg-input/80 inline-flex {$track} shrink-0 items-center rounded-full border border-transparent shadow-xs transition-all outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50") }}
>
    <span
        data-slot="switch-thumb"
        :data-state="checked ? 'checked' : 'unchecked'"
        class="bg-background dark:data-[state=unchecked]:bg-foreground dark:data-[state=checked]:bg-primary-foreground pointer-events-none block {{ $thumb }} rounded-full ring-0 transition-transform data-[state=checked]:translate-x-[calc(100%-2px)] data-[state=unchecked]:translate-x-0"
    ></span>
    @if ($name)
        <input type="hidden" :name="checked ? @js($name) : null" value="{{ $value }}">
    @endif
</button>
