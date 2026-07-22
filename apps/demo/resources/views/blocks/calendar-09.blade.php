<x-layouts.app title="Calendar 09">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="range" :value="['from' => '2025-06-17', 'to' => '2025-06-20']" default-month="2025-06-17" :number-of-months="2" :disabled="['dayOfWeek' => [0, 6]]" class="rounded-lg border shadow-sm" />
    </div>
</x-layouts.app>
