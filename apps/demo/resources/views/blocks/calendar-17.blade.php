<x-layouts.app title="Calendar 17">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card class="w-fit py-4">
            <x-ui.card-content class="px-4">
                <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" class="bg-transparent p-0 [--cell-size:2.8rem]" />
            </x-ui.card-content>
            <x-ui.card-footer class="*:[div]:w-full flex gap-2 border-t px-4 pb-0 pt-4">
                <div class="flex-1">
                    <x-ui.label for="time-from" class="sr-only">Start Time</x-ui.label>
                    <x-ui.input id="time-from" type="time" step="1" value="10:30:00"
                        class="appearance-none [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none" />
                </div>
                <span>-</span>
                <div class="flex-1">
                    <x-ui.label for="time-to" class="sr-only">End Time</x-ui.label>
                    <x-ui.input id="time-to" type="time" step="1" value="12:30:00"
                        class="appearance-none [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none" />
                </div>
            </x-ui.card-footer>
        </x-ui.card>
    </div>
</x-layouts.app>
