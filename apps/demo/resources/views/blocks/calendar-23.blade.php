<x-layouts.app title="Calendar 23">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div
            x-data="{
                open: false,
                value: { from: null, to: null },
                fmt(d) {
                    return d ? new Date(d + 'T00:00:00').toLocaleDateString() : '';
                },
                get label() {
                    return (this.value.from && this.value.to)
                        ? this.fmt(this.value.from) + ' - ' + this.fmt(this.value.to)
                        : '';
                }
            }"
            @calendar-change="value = $event.detail"
            class="relative flex flex-col gap-3"
        >
            <x-ui.label for="dates" class="px-1">Select your stay</x-ui.label>

            <button
                type="button"
                id="dates"
                x-ref="trigger"
                @click="open = !open"
                class="border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 w-56 items-center justify-between gap-2 rounded-md border bg-background px-3 py-2 text-left text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
            >
                <span x-text="label || 'Select date'"></span>
                <x-lucide-chevron-down class="size-4 opacity-50" />
            </button>

            <div
                x-show="open"
                x-cloak
                x-anchor.bottom-start.offset.4="$refs.trigger"
                @click.outside="open = false"
                @keydown.escape.window="open = false"
                x-trap="open"
                class="bg-popover text-popover-foreground z-50 w-auto origin-top overflow-hidden rounded-md border p-0 shadow-md"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
            >
                <x-ui.calendar mode="range" caption-layout="dropdown" class="border-0" />
            </div>
        </div>
    </div>
</x-layouts.app>
