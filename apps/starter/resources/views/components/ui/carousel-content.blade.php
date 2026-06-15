<div
    data-slot="carousel-content"
    @pointerdown="onPointerDown($event)"
    @pointerup.window="onPointerUp($event)"
    @pointercancel.window="drag.active = false"
    :class="orientation === 'vertical' ? 'touch-pan-x' : 'touch-pan-y'"
    {{ $attributes->twMerge('overflow-hidden') }}
>
    <div
        x-ref="track"
        class="flex"
        :class="orientation === 'vertical' ? '-mt-4 h-full flex-col' : '-ml-4'"
        :style="orientation === 'vertical'
            ? `transform: translateY(-${index * 100}%); transition: transform .3s ease`
            : `transform: translateX(-${index * 100}%); transition: transform .3s ease`"
    >
        {{ $slot }}
    </div>
</div>
