<x-layouts.app title="Calendar 13">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="flex flex-col gap-4">
            <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" caption-layout="dropdown" class="rounded-lg border shadow-sm" />
            <div class="flex flex-col gap-3">
                <x-ui.label for="dropdown" class="px-1">Dropdown</x-ui.label>
                <x-ui.select value="dropdown">
                    <x-ui.select-trigger id="dropdown" class="bg-background w-full">
                        <x-ui.select-value placeholder="Dropdown" />
                    </x-ui.select-trigger>
                    <x-ui.select-content align="center">
                        <x-ui.select-item value="dropdown">Month and Year</x-ui.select-item>
                        <x-ui.select-item value="dropdown-months">Month Only</x-ui.select-item>
                        <x-ui.select-item value="dropdown-years">Year Only</x-ui.select-item>
                    </x-ui.select-content>
                </x-ui.select>
            </div>
        </div>
    </div>
</x-layouts.app>
