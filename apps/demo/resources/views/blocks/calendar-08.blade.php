<x-layouts.app title="Calendar 08">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" :disabled="['before' => '2025-06-12']" class="rounded-lg border shadow-sm" />
    </div>
</x-layouts.app>
