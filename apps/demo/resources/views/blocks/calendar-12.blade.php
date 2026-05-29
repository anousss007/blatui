<x-layouts.app title="Calendar 12">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card>
            <x-ui.card-header class="relative border-b">
                <x-ui.card-title>Reserva una cita</x-ui.card-title>
                <x-ui.card-description>Selecciona las fechas para tu cita</x-ui.card-description>
                <x-ui.select value="es">
                    <x-ui.select-trigger class="absolute right-4 top-4 w-[100px]">
                        <x-ui.select-value placeholder="Language" />
                    </x-ui.select-trigger>
                    <x-ui.select-content align="end">
                        <x-ui.select-item value="es">Español</x-ui.select-item>
                        <x-ui.select-item value="en">English</x-ui.select-item>
                    </x-ui.select-content>
                </x-ui.select>
            </x-ui.card-header>
            <x-ui.card-content class="pt-4">
                <x-ui.calendar mode="range" :value="['from' => '2025-09-09', 'to' => '2025-09-17']" default-month="2025-09-09" :number-of-months="2" locale="es-ES" button-variant="outline" class="bg-transparent p-0" />
            </x-ui.card-content>
        </x-ui.card>
    </div>
</x-layouts.app>
