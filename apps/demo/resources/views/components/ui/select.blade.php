{{--
    Select root.
      native  false (default) -> the BlatUI JS listbox (rich, custom options).
              true            -> a bare, BlatUI-styled native <select> for no-JS form
                                 layers (submits without JS, name-bound). Put <option>s in
                                 the slot and mark the selected one with `selected`.
      size    sm | default | lg  (native only; height)
      multiple false (default) -> single pick. true -> pick many; selected render as
              removable chips in the trigger and the list stays open. Submits as `name[]`.
      options [value => label] shorthand — auto-composes trigger/content/items (or <option>s
              when native). Omit it to use the compositional API via the slot.
      placeholder  trigger text when nothing is selected (pass a translated string; '' by default
                   so no English ever leaks).
--}}
@props([
    'name' => null,
    'value' => '',
    'native' => false,
    'size' => 'default',
    'multiple' => false,
    'options' => null,
    'placeholder' => '',
    'color' => null,
    'indicator' => 'check',   // check | checkbox | radio — how a selected option is marked (custom listbox only)
])

@php
    $hasOptions = is_array($options) && count($options) > 0;
    // Normalise to [value => label]: associative keys are values; a plain list uses value === label.
    $normalized = [];
    if ($hasOptions) {
        foreach ($options as $k => $v) {
            if (is_int($k)) {
                $normalized[(string) $v] = (string) $v;
            } else {
                $normalized[(string) $k] = (string) $v;
            }
        }
    }

    // Multiple seeds an array of values; single keeps the scalar string.
    $selectedValues = collect(is_array($value) ? $value : (($value === '' || $value === null) ? [] : [$value]))
        ->map(fn ($v) => (string) $v)->values();
    $initialValue = $multiple ? $selectedValues : (string) $value;

    // `color` brands the trigger's focus ring locally (overrides the ring/primary tokens).
    $colorStyle = $color ? "--ring: {$color}; --primary: {$color}; --primary-foreground: #ffffff;" : '';
    $userStyle = (string) $attributes->get('style', '');
    $style = trim($colorStyle.($colorStyle && $userStyle ? ' ' : '').$userStyle);
    $attributes = $attributes->except('style');

    // Livewire bridge — the native <select> binds wire:model directly; the custom listbox
    // entangles its Alpine value instead. No-op without Livewire.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if (! $native && $hasWire) { $attributes = $attributes->whereDoesntStartWith('wire:model'); }
@endphp

@if ($native)
    @php
        $nativeSizes = ['sm' => 'h-8 text-sm', 'default' => 'h-9', 'lg' => 'h-10'];
        $nativeSize = $nativeSizes[$size] ?? $nativeSizes['default'];
    @endphp
    <select
        @if ($name) name="{{ $name }}{{ $multiple ? '[]' : '' }}" @endif
        @if ($multiple) multiple @endif
        data-slot="select"
        data-size="{{ $size }}"
        @if ($style) style="{{ $style }}" @endif
        {{ $attributes->twMerge('blat-select '.($multiple ? 'h-auto min-h-9 py-1' : $nativeSize)) }}
    >
        @if ($hasOptions)
            @if (! $multiple && $placeholder !== '')
                <option value="" disabled @selected($value === '')>{{ $placeholder }}</option>
            @endif
            @foreach ($normalized as $val => $lab)
                <option value="{{ $val }}" @selected($selectedValues->contains((string) $val))>{{ $lab }}</option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
@else
    <div
        data-slot="select"
        x-data="blatSelect({ value: @if ($hasWire)@entangle($wireModel)@else @js($initialValue)@endif, multiple: @js((bool) $multiple)@if ($hasWire), entangled: true @endif })"
        x-id="['blat-listbox']"
        @if ($style) style="{{ $style }}" @endif
        {{ $attributes->twMerge('relative') }}
    >
        @if ($name)
            @if ($multiple)
                <template x-for="v in value" :key="v">
                    <input type="hidden" name="{{ $name }}[]" :value="v">
                </template>
            @else
                <input type="hidden" name="{{ $name }}" :value="value">
            @endif
        @endif
        @if ($hasOptions)
            <x-ui.select-trigger :class="'w-full'.($multiple ? ' data-[size=default]:h-auto min-h-9 py-1' : '')" :ariaLabel="$placeholder !== '' ? $placeholder : 'Select option'">
                <x-ui.select-value :placeholder="$placeholder" />
            </x-ui.select-trigger>
            <x-ui.select-content :indicator="$indicator">
                @foreach ($normalized as $val => $lab)
                    <x-ui.select-item :value="$val">{{ $lab }}</x-ui.select-item>
                @endforeach
            </x-ui.select-content>
        @else
            {{ $slot }}
        @endif
    </div>
@endif
