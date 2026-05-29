@php
    $booked = collect(range(15, 26))->map(fn ($d) => '2025-06-'.str_pad($d, 2, '0', STR_PAD_LEFT))->all();
@endphp

<x-layouts.app title="Calendar 14">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.calendar
            mode="single"
            value="2025-06-12"
            default-month="2025-06-12"
            :disabled="$booked"
            :modifiers="['booked' => $booked]"
            :modifiers-class="['booked' => 'line-through opacity-100']"
            class="rounded-lg border shadow-sm"
        />
    </div>
</x-layouts.app>
