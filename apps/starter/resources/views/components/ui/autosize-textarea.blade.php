{{-- DEPRECATED: use <x-ui.textarea :rows="…" :max-rows="…"> instead. Kept as a thin alias. --}}
@props([
    'name' => null,
    'placeholder' => null,
    'minRows' => 2,
    'maxRows' => null,
    'size' => 'default',
    'disabled' => false,
    'id' => null,
    'value' => null,
])

{{-- Map the old vocabulary onto the unified textarea contract: minRows → rows, maxRows → maxRows.
     Forward name/placeholder/disabled/value/size/id plus any extra $attributes verbatim. --}}
<x-ui.textarea
    :rows="(int) $minRows"
    :max-rows="$maxRows"
    :size="$size"
    :name="$name"
    :id="$id"
    :placeholder="$placeholder"
    :disabled="$disabled"
    {{ $attributes }}
>{{ $value !== null ? $value : $slot }}</x-ui.textarea>
