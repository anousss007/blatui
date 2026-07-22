@props([
    'open' => false,
    'label' => 'Reasoning',
    'duration' => null,
    'id' => null,
])

@php
    $headerLabel = $duration ? 'Thought for '.$duration : $label;
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
        @click="open = !open"
        :aria-expanded="open"
        @if ($id) aria-controls="{{ $id }}" @else :aria-controls="$id('blat-reasoning')" @endif
        :data-state="open ? 'open' : 'closed'"
        class="group inline-flex items-center gap-2 rounded-md text-muted-foreground outline-none transition-colors hover:text-foreground focus-visible:ring-[3px] focus-visible:ring-ring/50"
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
        class="mt-2 border-s-2 border-border ps-4 text-sm leading-relaxed text-muted-foreground"
    >
        {{ $slot }}
    </div>
</div>
