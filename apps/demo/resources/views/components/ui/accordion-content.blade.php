<div
    data-slot="accordion-content"
    role="region"
    :id="$id('blat-accordion-panel', _v)"
    :aria-labelledby="$id('blat-accordion-trigger', _v)"
    x-show="isOpen(_v)"
    x-collapse
    x-cloak
    :data-state="isOpen(_v) ? 'open' : 'closed'"
    class="overflow-hidden text-sm"
>
    <div {{ $attributes->twMerge('pt-0 pb-4') }}>
        {{ $slot }}
    </div>
</div>
