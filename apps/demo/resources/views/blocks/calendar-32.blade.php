<x-layouts.app title="Calendar 32">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div
            x-data="{
                value: null,
                get label() {
                    return this.value ? new Date(this.value + 'T00:00:00').toLocaleDateString() : '';
                }
            }"
            @calendar-change="value = $event.detail"
            class="flex flex-col gap-3"
        >
            <x-ui.label for="date" class="px-1">Date of birth</x-ui.label>

            <x-ui.drawer @calendar-change="open = false">
                <x-ui.drawer-trigger>
                    <button
                        type="button"
                        id="date"
                        class="border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 w-48 items-center justify-between gap-2 rounded-md border bg-background px-3 py-2 text-left text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                    >
                        <span x-text="label || 'Select date'"></span>
                        <x-lucide-calendar-plus class="size-4 opacity-50" />
                    </button>
                </x-ui.drawer-trigger>

                <x-ui.drawer-content class="w-auto overflow-hidden p-0">
                    <x-ui.drawer-header class="sr-only">
                        <x-ui.drawer-title>Select date</x-ui.drawer-title>
                        <x-ui.drawer-description>Set your date of birth</x-ui.drawer-description>
                    </x-ui.drawer-header>

                    <x-ui.calendar
                        mode="single"
                        caption-layout="dropdown"
                        class="mx-auto border-0 [--cell-size:clamp(0px,calc(100vw/7.5),52px)]"
                    />
                </x-ui.drawer-content>
            </x-ui.drawer>

            <div class="text-muted-foreground px-1 text-sm">
                This example works best on mobile.
            </div>
        </div>
    </div>
</x-layouts.app>
