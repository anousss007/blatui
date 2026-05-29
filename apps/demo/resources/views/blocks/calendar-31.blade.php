<x-layouts.app title="Calendar 31">
    @php
        $events = [
            ['title' => 'Team Sync Meeting', 'from' => '2025-06-12T09:00:00', 'to' => '2025-06-12T10:00:00'],
            ['title' => 'Design Review', 'from' => '2025-06-12T11:30:00', 'to' => '2025-06-12T12:30:00'],
            ['title' => 'Client Presentation', 'from' => '2025-06-12T14:00:00', 'to' => '2025-06-12T15:00:00'],
        ];

        // Compact same-day time range, mirroring little-date's formatDateRange.
        $fmtRange = function ($from, $to) {
            $f = \Carbon\Carbon::parse($from);
            $t = \Carbon\Carbon::parse($to);
            $datePart = $f->format('M j');
            if ($f->format('A') === $t->format('A')) {
                return $datePart.', '.$f->format('g:i').' - '.$t->format('g:i A');
            }
            return $datePart.', '.$f->format('g:i A').' - '.$t->format('g:i A');
        };

        $eventDays = array_values(array_unique(array_map(fn ($e) => \Carbon\Carbon::parse($e['from'])->format('Y-m-d'), $events)));
    @endphp
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card class="w-fit py-4">
            <x-ui.card-content class="px-4">
                <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" :required="true"
                    :modifiers="['hasEvent' => $eventDays]"
                    :modifiers-class="['hasEvent' => 'relative after:absolute after:bottom-1 after:left-1/2 after:-translate-x-1/2 after:size-1 after:rounded-full after:bg-primary']"
                    class="bg-transparent p-0" />
            </x-ui.card-content>
            <x-ui.card-footer class="flex flex-col items-start gap-3 border-t px-4 pb-0 pt-4">
                <div class="flex w-full items-center justify-between px-1">
                    <div class="text-sm font-medium"
                        x-data="{
                            date: '2025-06-12',
                            label() {
                                if (!this.date) return '';
                                const p = String(this.date).split('-').map(Number);
                                return new Date(p[0], p[1] - 1, p[2]).toLocaleDateString('en-US', { day: 'numeric', month: 'long', year: 'numeric' });
                            },
                        }"
                        @calendar-change.window="date = $event.detail"
                        x-text="label()">
                    </div>
                    <x-ui.button variant="ghost" size="icon" class="h-6 w-6" title="Add Event">
                        <x-lucide-plus />
                        <span class="sr-only">Add Event</span>
                    </x-ui.button>
                </div>
                <div class="flex w-full flex-col gap-2">
                    @foreach ($events as $event)
                        <div class="bg-muted after:bg-primary/70 relative rounded-md p-2 pl-6 text-sm after:absolute after:inset-y-2 after:left-2 after:w-1 after:rounded-full">
                            <div class="font-medium">{{ $event['title'] }}</div>
                            <div class="text-muted-foreground text-xs">{{ $fmtRange($event['from'], $event['to']) }}</div>
                        </div>
                    @endforeach
                </div>
            </x-ui.card-footer>
        </x-ui.card>
    </div>
</x-layouts.app>
