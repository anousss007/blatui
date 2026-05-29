<div
    role="group"
    aria-roledescription="slide"
    data-slot="carousel-item"
    :class="orientation === 'vertical' ? 'pt-4' : 'pl-4'"
    {{ $attributes->twMerge('min-w-0 shrink-0 grow-0 basis-full') }}
>
    {{ $slot }}
</div>
