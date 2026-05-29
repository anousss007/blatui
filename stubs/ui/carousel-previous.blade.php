<button
    type="button"
    @click="prev()"
    :disabled="!canPrev"
    data-slot="carousel-previous"
    :class="orientation === 'horizontal' ? 'top-1/2 -left-12 -translate-y-1/2' : '-top-12 left-1/2 -translate-x-1/2 rotate-90'"
    {{ $attributes->twMerge('border-input hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input absolute inline-flex size-8 items-center justify-center rounded-full border bg-background shadow-xs transition-all outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50') }}
>
    <x-lucide-arrow-left class="size-4" />
    <span class="sr-only">Previous slide</span>
</button>
