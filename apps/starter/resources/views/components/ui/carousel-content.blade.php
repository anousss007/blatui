<div data-slot="carousel-content" {{ $attributes->twMerge('overflow-hidden') }}>
    <div
        x-ref="track"
        class="flex"
        :class="orientation === 'vertical' ? '-mt-4 flex-col' : '-ml-4'"
        :style="orientation === 'vertical'
            ? `transform: translateY(-${index * 100}%); transition: transform .3s ease`
            : `transform: translateX(-${index * 100}%); transition: transform .3s ease`"
    >
        {{ $slot }}
    </div>
</div>
