<x-layouts.app title="Calendar 05">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="range" :value="['from' => '2025-06-12', 'to' => '2025-07-15']" default-month="2025-06-12" :number-of-months="2" class="rounded-lg border shadow-sm" />
    </div>
</x-layouts.app>
