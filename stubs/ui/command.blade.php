<div
    data-slot="command"
    x-data="{
        query: '',
        items: [],
        matches(kw) { return kw.toLowerCase().includes(this.query.toLowerCase()) },
        get visibleCount() { return this.items.filter(kw => this.matches(kw)).length }
    }"
    {{ $attributes->twMerge('bg-popover text-popover-foreground flex h-full w-full flex-col overflow-hidden rounded-md') }}
>
    {{ $slot }}
</div>
