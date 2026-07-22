@props([
    'name' => null,
    'value' => 0,
    'max' => 5,
    'readonly' => false,
    'size' => 'default',
    'icon' => 'star',              // any lucide icon name (e.g. star, heart)
    'color' => 'text-amber-500',  // filled colour
    'id' => null,
])

@php
    $sizes = ['sm' => 'size-4', 'default' => 'size-5', 'lg' => 'size-6'];
    $star = $sizes[$size] ?? $sizes['default'];
@endphp

<div
    data-slot="rating"
    x-data="{
        value: @js((float) $value),
        hover: 0,
        max: @js((int) $max),
        readonly: @js((bool) $readonly),
        set(v) { if (this.readonly) return; this.value = v; },
        get current() { return this.hover || this.value; },
    }"
    role="radiogroup"
    @if ($name) aria-label="{{ $name }}" @endif
    @mouseleave="hover = 0"
    @keydown.arrow-right.prevent="!readonly && set(Math.min(max, value + 1))"
    @keydown.arrow-up.prevent="!readonly && set(Math.min(max, value + 1))"
    @keydown.arrow-left.prevent="!readonly && set(Math.max(0, value - 1))"
    @keydown.arrow-down.prevent="!readonly && set(Math.max(0, value - 1))"
    {{ $attributes->twMerge('inline-flex items-center gap-0.5') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value" @if ($id) id="{{ $id }}" @endif>
    @endif

    <template x-for="i in max" :key="i">
        <button
            type="button"
            role="radio"
            :aria-checked="value === i"
            :aria-label="i + ' / ' + max"
            :tabindex="readonly ? -1 : (i === (value || 1) ? 0 : -1)"
            :disabled="readonly"
            @click="set(i)"
            @mouseenter="!readonly && (hover = i)"
            @focus="!readonly && (hover = i)"
            class="rounded-sm outline-none transition-colors not-disabled:cursor-pointer focus-visible:ring-ring/50 focus-visible:ring-[3px]"
            :class="current >= i ? '{{ $color }}' : 'text-muted-foreground/30'"
        >
            <x-dynamic-component :component="'lucide-'.$icon" class="{{ $star }}" x-bind:class="current >= i ? 'fill-current' : 'fill-none'" aria-hidden="true" />
        </button>
    </template>
</div>
