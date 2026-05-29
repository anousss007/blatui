<x-layouts.app title="Calendar 20">
    @php
        $timeSlots = [];
        for ($i = 0; $i < 37; $i++) {
            $totalMinutes = $i * 15;
            $hour = intdiv($totalMinutes, 60) + 9;
            $minute = $totalMinutes % 60;
            $timeSlots[] = sprintf('%02d:%02d', $hour, $minute);
        }
        $bookedDates = ['2025-06-17', '2025-06-18', '2025-06-19'];
    @endphp
    <div class="flex min-h-svh items-center justify-center p-6">
        <div x-data="{ date: '2025-06-12', selectedTime: '10:00' }"
            @calendar-change.window="date = $event.detail"
            x-init="
                $watch('date', () => {});
                window.calendar20Label = (d) => {
                    if (!d) return '';
                    const p = String(d).split('-').map(Number);
                    return new Date(p[0], p[1] - 1, p[2]).toLocaleDateString('en-US', { weekday: 'long', day: 'numeric', month: 'long' });
                };
            ">
            <x-ui.card class="gap-0 p-0">
                <x-ui.card-content class="relative p-0 md:pr-48">
                    <div class="p-6">
                        <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12"
                            :disabled="$bookedDates"
                            :modifiers="['booked' => $bookedDates]"
                            :modifiers-class="['booked' => '[&>button]:line-through opacity-100']"
                            class="bg-transparent p-0 [--cell-size:2.5rem] md:[--cell-size:3rem]" />
                    </div>
                    <div class="no-scrollbar inset-y-0 right-0 flex max-h-72 w-full scroll-pb-6 flex-col gap-4 overflow-y-auto border-t p-6 md:absolute md:max-h-none md:w-48 md:border-l md:border-t-0">
                        <div class="grid gap-2">
                            @foreach ($timeSlots as $time)
                                <x-ui.button variant="outline"
                                    x-on:click="selectedTime = '{{ $time }}'"
                                    x-bind:class="selectedTime === '{{ $time }}'
                                        ? 'bg-primary text-primary-foreground hover:bg-primary/90 border-transparent'
                                        : ''"
                                    class="w-full shadow-none">
                                    {{ $time }}
                                </x-ui.button>
                            @endforeach
                        </div>
                    </div>
                </x-ui.card-content>
                <x-ui.card-footer class="flex flex-col gap-4 border-t !py-5 px-6 md:flex-row">
                    <div class="text-sm">
                        <template x-if="date && selectedTime">
                            <span>
                                Your meeting is booked for
                                <span class="font-medium" x-text="' ' + window.calendar20Label(date) + ' '"></span>
                                at <span class="font-medium" x-text="selectedTime"></span>.
                            </span>
                        </template>
                        <template x-if="!(date && selectedTime)">
                            <span>Select a date and time for your meeting.</span>
                        </template>
                    </div>
                    <x-ui.button variant="outline" class="w-full md:ml-auto md:w-auto"
                        x-bind:disabled="!(date && selectedTime)">
                        Continue
                    </x-ui.button>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
