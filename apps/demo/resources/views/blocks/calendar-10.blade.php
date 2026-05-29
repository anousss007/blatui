<x-layouts.app title="Calendar 10">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card>
            <x-ui.card-header class="relative">
                <x-ui.card-title>Appointment</x-ui.card-title>
                <x-ui.card-description>Find a date</x-ui.card-description>
                <x-ui.button size="sm" variant="outline" class="absolute right-4 top-4"
                    x-on:click="$dispatch('calendar:today')"
                    onclick="window.dispatchEvent(new CustomEvent('calendar:today'))">
                    Today
                </x-ui.button>
            </x-ui.card-header>
            <x-ui.card-content>
                <x-ui.calendar mode="single" value="2025-06-12" :default-month="now()->format('Y-m-d')" class="bg-transparent p-0" />
            </x-ui.card-content>
        </x-ui.card>
    </div>
</x-layouts.app>
