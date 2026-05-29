<div
    x-data="{
        open: false,
        from: '2025-06-09',
        to: '2025-06-26',
        fmt(d) { return d ? new Date(d + 'T00:00:00').toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : ''; },
        get label() {
            if (this.from && this.to) return this.fmt(this.from) + ' - ' + this.fmt(this.to);
            if (this.from) return this.fmt(this.from);
            return '';
        },
    }"
    @calendar-change="from = $event.detail.from; to = $event.detail.to; if (from && to) open = false"
    class="relative"
>
    <x-ui.button variant="outline" x-ref="trigger" x-on:click="open = !open"
        class="w-[300px] justify-start text-left font-normal" ::class="!from && 'text-muted-foreground'">
        <x-lucide-calendar class="mr-2 size-4 opacity-50" />
        <span x-text="label || 'Pick a date range'"></span>
    </x-ui.button>
    <div x-show="open" x-cloak x-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false" @keydown.escape.window="open = false"
        class="bg-popover text-popover-foreground z-50 overflow-hidden rounded-md border shadow-md">
        <x-ui.calendar mode="range" :number-of-months="2"
            :value="['from' => '2025-06-09', 'to' => '2025-06-26']" default-month="2025-06-09" class="border-0" />
    </div>
</div>
