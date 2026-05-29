<div
    data-slot="accordion-content"
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
