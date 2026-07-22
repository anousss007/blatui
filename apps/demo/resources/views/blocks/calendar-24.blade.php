<x-layouts.app title="Calendar 24">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="flex gap-4">
            <div
                x-data="{
                    open: false,
                    value: null,
                    get label() {
                        return this.value ? new Date(this.value + 'T00:00:00').toLocaleDateString() : '';
                    }
                }"
                @calendar-change="value = $event.detail; open = false"
                class="relative flex flex-col gap-3"
            >
                <x-ui.label for="date" class="px-1">Date</x-ui.label>

                <button
                    type="button"
                    id="date"
                    x-ref="trigger"
                    @click="open = !open"
                    class="border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 w-32 items-center justify-between gap-2 rounded-md border bg-background px-3 py-2 text-left text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
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
                    <x-ui.calendar mode="single" caption-layout="dropdown" class="border-0" />
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <x-ui.label for="time" class="px-1">Time</x-ui.label>
                <x-ui.input
                    type="time"
                    id="time"
                    step="1"
                    value="10:30:00"
                    class="bg-background appearance-none [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none"
                />
            </div>
        </div>
    </div>
</x-layouts.app>
