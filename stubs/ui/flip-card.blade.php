@props([
    'trigger' => 'hover',   // hover | click
    'height' => null,       // CSS height for the perspective box, e.g. '16rem' (faces are absolute)
])

@php
    $trigger = in_array($trigger, ['hover', 'click'], true) ? $trigger : 'hover';
    $isClick = $trigger === 'click';

    // Faces are absolutely positioned, so the box needs an explicit height.
    $boxHeight = $height ?: '16rem';

    // Named `front` slot wins; otherwise the default slot is the front face.
    $hasFront = isset($front) && ! $front->isEmpty();
@endphp

<div
    data-slot="flip-card"
    x-data="{ flipped: false }"
    @if (! $isClick)
        @mouseenter="flipped = true"
        @mouseleave="flipped = false"
        @focusin="flipped = true"
        @focusout="flipped = false"
    @endif
    style="perspective: 1000px; height: {{ $boxHeight }};"
    {{ $attributes->twMerge('relative w-full') }}
>
    {{-- The flipper: rotates around Y to swap faces. Click trigger makes it an interactive button. --}}
    <{{ $isClick ? 'button' : 'div' }}
        @if ($isClick)
            type="button"
            @click="flipped = !flipped"
            :aria-pressed="flipped ? 'true' : 'false'"
        @endif
        data-slot="flip-card-flipper"
        class="relative block size-full text-start outline-none transition-transform duration-500 [transform-style:preserve-3d] focus-visible:ring-ring/50 focus-visible:ring-[3px] focus-visible:ring-offset-2 focus-visible:ring-offset-background rounded-xl @if ($isClick) cursor-pointer @endif"
        :class="flipped ? '[transform:rotateY(180deg)]' : ''"
    >
        {{-- Front face --}}
        <div
            data-slot="flip-card-front"
            class="bg-card text-card-foreground absolute inset-0 flex flex-col overflow-hidden rounded-xl border p-6 shadow-sm [backface-visibility:hidden] [-webkit-backface-visibility:hidden]"
            :inert="flipped"
            :aria-hidden="flipped ? 'true' : 'false'"
        >
            {{ $hasFront ? $front : $slot }}
        </div>

        {{-- Back face (pre-rotated so it reads correctly once the flipper turns) --}}
        <div
            data-slot="flip-card-back"
            class="bg-card text-card-foreground absolute inset-0 flex flex-col overflow-hidden rounded-xl border p-6 shadow-sm [backface-visibility:hidden] [-webkit-backface-visibility:hidden] [transform:rotateY(180deg)]"
            :inert="!flipped"
            :aria-hidden="flipped ? 'false' : 'true'"
        >
            {{ $back ?? '' }}
        </div>
    </{{ $isClick ? 'button' : 'div' }}>
</div>
