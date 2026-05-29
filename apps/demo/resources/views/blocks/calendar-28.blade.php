<x-layouts.app title="Calendar 28">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div
            x-data="{
                open: false,
                value: '',
                fmt(d) {
                    if (!d) return '';
                    return new Date(d + 'T00:00:00').toLocaleDateString('en-US', { day: '2-digit', month: 'long', year: 'numeric' });
                },
                init() {
                    this.value = this.fmt('2025-06-01');
                }
            }"
            @calendar-change="value = fmt($event.detail); open = false"
            class="flex flex-col gap-3"
        >
            <x-ui.label for="date" class="px-1">Subscription Date</x-ui.label>

            <div class="relative flex gap-2">
                <x-ui.input
                    id="date"
                    x-model="value"
                    placeholder="June 01, 2025"
                    class="bg-background pr-10"
                    @keydown.arrow-down.prevent="open = true"
                />

                <button
                    type="button"
                    id="date-picker"
                    x-ref="trigger"
                    @click="open = !open"
                    class="absolute right-2 top-1/2 inline-flex size-6 -translate-y-1/2 items-center justify-center gap-2 rounded-md text-sm font-medium transition-all outline-none hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                >
                    <x-lucide-calendar class="size-3" />
                    <span class="sr-only">Select date</span>
                </button>

                <div
                    x-show="open"
                    x-cloak
                    x-anchor.bottom-end.offset.4="$refs.trigger"
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                    x-trap="open"
                    class="bg-popover text-popover-foreground z-50 w-auto origin-top overflow-hidden rounded-md border p-0 shadow-md"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                >
                    <x-ui.calendar mode="single" :value="'2025-06-01'" default-month="2025-06-01" caption-layout="dropdown" class="border-0" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
