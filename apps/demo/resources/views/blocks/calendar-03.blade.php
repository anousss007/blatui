<x-layouts.app title="Calendar 03">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="multiple" :value="['2025-06-12', '2025-07-24']" default-month="2025-06-12" :number-of-months="2" :max="5" :required="true" class="rounded-lg border shadow-sm" />
    </div>
</x-layouts.app>
