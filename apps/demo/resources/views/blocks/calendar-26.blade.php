<x-layouts.app title="Calendar 26">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div
            class="flex w-full max-w-64 min-w-0 flex-col gap-6"
            x-data="{
                dateFrom: '2025-06-01',
                dateTo: '2025-06-03',
                fmt(v) {
                    if (!v) return 'Select date';
                    return new Date(v + 'T00:00:00').toLocaleDateString('en-US', { day: '2-digit', month: 'short', year: 'numeric' });
                },
            }"
        >
            <div class="flex gap-4">
                <div class="flex flex-1 flex-col gap-3">
                    <x-ui.label for="date-from" class="px-1">Check-in</x-ui.label>
                    <x-ui.popover @calendar-change="dateFrom = $event.detail; open = false">
                        <x-ui.popover-trigger>
                            <x-ui.button variant="outline" id="date-from" class="w-full justify-between font-normal">
                                <span x-text="fmt(dateFrom)"></span>
                                <x-lucide-chevron-down />
                            </x-ui.button>
                        </x-ui.popover-trigger>
                        <x-ui.popover-content align="start" class="w-auto overflow-hidden p-0">
                            <x-ui.calendar mode="single" value="2025-06-01" caption-layout="dropdown" class="border-0" />
                        </x-ui.popover-content>
                    </x-ui.popover>
                </div>
                <div class="flex flex-col gap-3">
                    <x-ui.label for="time-from" class="invisible px-1">From</x-ui.label>
                    <x-ui.input
                        type="time"
                        id="time-from"
                        step="1"
                        value="10:30:00"
                        class="bg-background appearance-none [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none"
                    />
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex flex-1 flex-col gap-3">
                    <x-ui.label for="date-to" class="px-1">Check-out</x-ui.label>
                    <x-ui.popover @calendar-change="dateTo = $event.detail; open = false">
                        <x-ui.popover-trigger>
                            <x-ui.button variant="outline" id="date-to" class="w-full justify-between font-normal">
                                <span x-text="fmt(dateTo)"></span>
                                <x-lucide-chevron-down />
                            </x-ui.button>
                        </x-ui.popover-trigger>
                        <x-ui.popover-content align="start" class="w-auto overflow-hidden p-0">
                            <x-ui.calendar mode="single" value="2025-06-03" caption-layout="dropdown" :disabled="['before' => '2025-06-01']" class="border-0" />
                        </x-ui.popover-content>
                    </x-ui.popover>
                </div>
                <div class="flex flex-col gap-3">
                    <x-ui.label for="time-to" class="invisible px-1">To</x-ui.label>
                    <x-ui.input
                        type="time"
                        id="time-to"
                        step="1"
                        value="12:30:00"
                        class="bg-background appearance-none [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none"
                    />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
