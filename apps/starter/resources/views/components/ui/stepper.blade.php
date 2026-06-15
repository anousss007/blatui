@props([
    'value' => 1,                    // active step (1-based)
    'orientation' => 'horizontal',   // horizontal | vertical
])

<div
    data-slot="stepper"
    x-data="{ step: @js((int) $value), orientation: @js($orientation) }"
    :data-orientation="orientation"
    {{ $attributes->twMerge('flex flex-col gap-8') }}
>
    {{ $slot }}
</div>
