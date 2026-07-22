<div data-slot="item-content" {{ $attributes->twMerge('flex flex-1 flex-col gap-1 [&+[data-slot=item-content]]:flex-none') }}>
    {{ $slot }}
</div>
