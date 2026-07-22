<x-layouts.app title="Calendar 07">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="range" :value="['from' => '2025-06-18', 'to' => '2025-07-07']" default-month="2025-06-18" :number-of-months="2" :min="2" :max="20" class="rounded-lg border shadow-sm" />
    </div>
</x-layouts.app>
