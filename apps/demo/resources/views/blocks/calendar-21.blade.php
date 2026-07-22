<x-layouts.app title="Calendar 21">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar mode="range" :value="['from' => '2025-06-12', 'to' => '2025-06-17']" default-month="2025-06-12"
            :number-of-months="1" caption-layout="dropdown"
            class="rounded-lg border shadow-sm [--cell-size:2.75rem] md:[--cell-size:3rem]" />
    </div>
</x-layouts.app>
