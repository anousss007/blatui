<div data-slot="card-header" {{ $attributes->twMerge('@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6') }}>
    {{ $slot }}
</div>
