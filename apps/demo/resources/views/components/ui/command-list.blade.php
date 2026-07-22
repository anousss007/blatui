<div
    data-slot="command-list"
    role="listbox"
    tabindex="-1"
    :id="$id('blat-command-list')"
    {{ $attributes->twMerge('max-h-[300px] scroll-py-1 overflow-x-hidden overflow-y-auto') }}
>
    {{ $slot }}
</div>
