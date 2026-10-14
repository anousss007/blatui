@props([
    'open' => false,
    'label' => null,
    'duration' => null,
    'id' => null,
])

@php
    $label ??= __('Reasoning');
    $headerLabel = $duration ? __('Thought for :duration', ['duration' => $duration]) : $label;
@endphp

<div
    data-slot="reasoning"
    x-data="{ open: @js((bool) $open) }"
    x-id="['blat-reasoning']"
    {{ $attributes->twMerge('w-full text-sm') }}
>
    <button
        type="button"
        data-slot="reasoning-trigger"
        @click="open = ! open"
        :aria-expanded="open"
        @if ($id) aria-controls="{{ $id }}" @else :aria-controls="$id('blat-reasoning')" @endif
        :data-state="open ? 'open' : 'closed'"
        class="group text-muted-foreground hover:text-foreground focus-visible:ring-ring/50 inline-flex items-center gap-2 rounded-md transition-colors outline-none focus-visible:ring-[3px]"
    >
        <x-lucide-brain class="size-4 shrink-0" aria-hidden="true" />
        <span class="font-medium">{{ $headerLabel }}</span>
        <x-lucide-chevron-down
            class="size-4 shrink-0 transition-transform duration-200 rtl:-scale-x-100"
            x-bind:class="open ? 'rotate-180' : 'rotate-0'"
            aria-hidden="true"
        />
    </button>

    <div
        data-slot="reasoning-content"
        @if ($id) id="{{ $id }}" @else :id="$id('blat-reasoning')" @endif
        x-show="open"
        x-collapse
        x-cloak
        :data-state="open ? 'open' : 'closed'"
        class="border-border text-muted-foreground mt-2 border-s-2 ps-4 text-sm leading-relaxed"
    >
        {{ $slot }}
    </div>
</div>
