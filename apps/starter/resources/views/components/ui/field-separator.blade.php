<div
    data-slot="field-separator"
    {{ $attributes->twMerge('relative -my-2 h-5 text-sm') }}
>
    <div class="bg-border absolute inset-0 top-1/2 h-px"></div>
    @if (trim($slot) !== '')
        <span class="bg-background text-muted-foreground relative mx-auto block w-fit px-2">{{ $slot }}</span>
    @endif
</div>
