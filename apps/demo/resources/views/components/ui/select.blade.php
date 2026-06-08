{{--
    Select root.
      native  false (default) -> the BlatUI JS listbox (rich, custom options).
              true            -> a bare, BlatUI-styled native <select> for no-JS form
                                 layers (submits without JS, name-bound). Put <option>s in
                                 the slot and mark the selected one with `selected`.
      size    sm | default | lg  (native only; height)
--}}
@props([
    'name' => null,
    'value' => '',
    'native' => false,
    'size' => 'default',
])

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
        {{ $slot }}
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
        {{ $slot }}
    </div>
@endif
