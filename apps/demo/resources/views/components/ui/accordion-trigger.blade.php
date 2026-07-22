@props([
    'icon' => 'chevron',        // chevron | chevron-updown | plus-minus | plus | chevron-left | none
    'iconPosition' => 'right',  // right | left
])

@php
    // Open/closed state is driven by the parent button's data-state (set below via Alpine),
    // so the toggle icon reacts with pure CSS — no flash, matches the data-state idiom.
    $iconCls = 'text-muted-foreground pointer-events-none size-4 shrink-0 transition-transform duration-200'
        .($iconPosition === 'left' ? ' order-first' : '');
@endphp

<h3 class="flex">
    <button
        type="button"
        data-slot="accordion-trigger"
        @click="toggle(_v)"
        :id="$id('blat-accordion-trigger', _v)"
        :aria-controls="$id('blat-accordion-panel', _v)"
        :data-state="isOpen(_v) ? 'open' : 'closed'"
        :aria-expanded="isOpen(_v)"
        {{ $attributes->twMerge('focus-visible:border-ring focus-visible:ring-ring/50 flex flex-1 cursor-pointer items-start justify-between gap-4 rounded-md py-4 text-left text-sm font-medium transition-all outline-none hover:underline focus-visible:ring-[3px] disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50') }}
    >
        {{ $slot }}

        @switch($icon)
            @case('none')
                @break

            @case('plus-minus')
                <x-lucide-plus :class="$iconCls.' [[data-state=open]>&]:hidden'" />
                <x-lucide-minus :class="$iconCls.' hidden [[data-state=open]>&]:block'" />
                @break

            @case('plus')
                <x-lucide-plus :class="$iconCls.' [[data-state=open]>&]:rotate-45'" />
                @break

            @case('chevron-updown')
                <x-lucide-chevron-down :class="$iconCls.' [[data-state=open]>&]:hidden'" />
                <x-lucide-chevron-up :class="$iconCls.' hidden [[data-state=open]>&]:block'" />
                @break

            @case('chevron-left')
                <x-lucide-chevron-left :class="$iconCls.' [[data-state=open]>&]:-rotate-90'" />
                @break

            @default
                <x-lucide-chevron-down :class="$iconCls.' translate-y-0.5 [[data-state=open]>&]:rotate-180'" />
        @endswitch
    </button>
</h3>
