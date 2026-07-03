@aware(['indicator' => 'check'])

@props([
    'value' => '',
    'disabled' => false,
    'indicator' => 'check',   // check | checkbox | radio — usually set once on the select or select-content wrapper
])

@php
    $indicator = in_array($indicator, ['check', 'checkbox', 'radio'], true) ? $indicator : 'check';
    $jsVal = \Illuminate\Support\Js::from((string) $value)->toHtml();
@endphp

<div
    role="option"
    tabindex="-1"
    data-slot="select-item"
    data-value="{{ $value }}"
    @if ($disabled) data-disabled aria-disabled="true" @endif
    @if (! $disabled)
        @click="selectOption(@js((string) $value), $el.querySelector('[data-slot=select-item-label]').textContent.trim())"
    @endif
    x-init="seedSelected(@js((string) $value), $el.querySelector('[data-slot=select-item-label]').textContent.trim())"
    :aria-selected="isSelected(@js((string) $value))"
    :data-state="isSelected(@js((string) $value)) ? 'checked' : 'unchecked'"
    {{ $attributes->twMerge("hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm py-1.5 pr-8 pl-2 text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    @switch($indicator)
        @case('checkbox')
            <span class="absolute right-2 flex items-center justify-center">
                <span class="border-input flex size-4 items-center justify-center rounded-[4px] border transition-colors" :class="isSelected({!! $jsVal !!}) && 'bg-primary border-primary text-primary-foreground'">
                    <x-lucide-check class="size-3" x-bind:class="isSelected({!! $jsVal !!}) ? 'opacity-100' : 'opacity-0'" aria-hidden="true" />
                </span>
            </span>
            @break

        @case('radio')
            <span class="absolute right-2 flex items-center justify-center">
                <span class="border-input flex size-4 items-center justify-center rounded-full border transition-colors" :class="isSelected({!! $jsVal !!}) && 'border-primary'">
                    <span class="bg-primary size-2 rounded-full transition-opacity" :class="isSelected({!! $jsVal !!}) ? 'opacity-100' : 'opacity-0'"></span>
                </span>
            </span>
            @break

        @default
            <span class="absolute right-2 flex size-3.5 items-center justify-center">
                <x-lucide-check class="size-4" x-show="isSelected({!! $jsVal !!})" x-cloak aria-hidden="true" />
            </span>
    @endswitch
    <span data-slot="select-item-label" class="flex items-center gap-2">{{ $slot }}</span>
</div>
