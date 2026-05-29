<x-layouts.app title="Calendar 16">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card class="w-fit py-4">
            <x-ui.card-content class="px-4">
                <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" class="bg-transparent p-0" />
            </x-ui.card-content>
            <x-ui.card-footer class="flex flex-col gap-6 border-t px-4 pb-0 pt-4">
                <div class="flex w-full flex-col gap-3">
                    <x-ui.label for="time-from">Start Time</x-ui.label>
                    <div class="relative flex w-full items-center gap-2">
                        <x-lucide-clock-2 class="text-muted-foreground pointer-events-none absolute left-2.5 size-4 select-none" />
                        <x-ui.input id="time-from" type="time" step="1" value="10:30:00"
                            class="appearance-none pl-8 [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none" />
                    </div>
                </div>
                <div class="flex w-full flex-col gap-3">
                    <x-ui.label for="time-to">End Time</x-ui.label>
                    <div class="relative flex w-full items-center gap-2">
                        <x-lucide-clock-2 class="text-muted-foreground pointer-events-none absolute left-2.5 size-4 select-none" />
                        <x-ui.input id="time-to" type="time" step="1" value="12:30:00"
                            class="appearance-none pl-8 [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none" />
                    </div>
                </div>
            </x-ui.card-footer>
        </x-ui.card>
    </div>
</x-layouts.app>
