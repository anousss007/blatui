<div
    data-slot="tabs-list"
    role="tablist"
    :aria-orientation="orientation"
    :data-orientation="orientation"
    @keydown="$blatNav($event, { orientation, selector: '[role=tab]', loop: true })"
    {{ $attributes->twMerge('bg-muted text-muted-foreground inline-flex h-9 w-fit items-center justify-center rounded-lg p-[3px]') }}
>
    {{ $slot }}
</div>
