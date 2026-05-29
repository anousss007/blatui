@props(['placeholder' => ''])

<span
    data-slot="select-value"
    x-text="label || @js($placeholder)"
    :class="{ 'text-muted-foreground': !label }"
    {{ $attributes->twMerge('pointer-events-none') }}
></span>
