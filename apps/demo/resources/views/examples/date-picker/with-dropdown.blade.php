{{-- A date of birth picker with month/year dropdowns for fast navigation. --}}
<div
    x-data="{
        open: false,
        value: null,
        get label() { return this.value ? new Date(this.value + 'T00:00:00').toLocaleDateString('en-US', { day: '2-digit', month: 'long', year: 'numeric' }) : ''; },
    }"
    @calendar-change="value = $event.detail; open = false"
    class="relative"
>
    <x-ui.button variant="outline" x-ref="trigger" x-on:click="open = !open"
        class="w-48 justify-between font-normal" ::class="!value && 'text-muted-foreground'">
        <span x-text="label || 'Select date'"></span>
        <x-lucide-chevron-down class="size-4 opacity-50" />
    </x-ui.button>
    <div x-show="open" x-cloak x-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false" @keydown.escape.window="open = false"
        class="bg-popover text-popover-foreground z-50 overflow-hidden rounded-md border shadow-md">
        <x-ui.calendar mode="single" caption-layout="dropdown" default-month="2000-01-01" class="border-0" />
    </div>
</div>
