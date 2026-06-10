{{--
    Select root.
      native  false (default) -> the BlatUI JS listbox (rich, custom options).
              true            -> a bare, BlatUI-styled native <select> for no-JS form
                                 layers (submits without JS, name-bound). Put <option>s in
                                 the slot and mark the selected one with `selected`.
      size    sm | default | lg  (native only; height)
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
    'options' => null,
    'placeholder' => '',
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
@endphp

@if ($native)
    @php
        $nativeSizes = ['sm' => 'h-8 text-sm', 'default' => 'h-9', 'lg' => 'h-10'];
        $nativeSize = $nativeSizes[$size] ?? $nativeSizes['default'];
    @endphp
    <select
        @if ($name) name="{{ $name }}" @endif
        data-slot="select"
        data-size="{{ $size }}"
        {{ $attributes->twMerge('blat-select '.$nativeSize) }}
    >
        @if ($hasOptions)
            @if ($placeholder !== '')
                <option value="" disabled @selected($value === '')>{{ $placeholder }}</option>
            @endif
            @foreach ($normalized as $val => $lab)
                <option value="{{ $val }}" @selected((string) $value === (string) $val)>{{ $lab }}</option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
@else
    <div
        data-slot="select"
        x-data="blatSelect({ value: @js((string) $value) })"
        x-id="['blat-listbox']"
        {{ $attributes->twMerge('relative') }}
    >
        @if ($name)
            <input type="hidden" name="{{ $name }}" :value="value">
        @endif
        @if ($hasOptions)
            <x-ui.select-trigger class="w-full">
                <x-ui.select-value :placeholder="$placeholder" />
            </x-ui.select-trigger>
            <x-ui.select-content>
                @foreach ($normalized as $val => $lab)
                    <x-ui.select-item :value="$val">{{ $lab }}</x-ui.select-item>
                @endforeach
            </x-ui.select-content>
        @else
            {{ $slot }}
        @endif
    </div>
@endif
