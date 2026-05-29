<x-layouts.app title="Calendar 04">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="range" :value="['from' => '2025-06-09', 'to' => '2025-06-26']" default-month="2025-06-09" class="rounded-lg border shadow-sm" />
    </div>
</x-layouts.app>
