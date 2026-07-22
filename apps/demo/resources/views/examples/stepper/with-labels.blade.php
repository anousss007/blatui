{{-- Each indicator paired with a short label. --}}
<x-ui.stepper :value="2" class="w-full max-w-2xl">
    <x-ui.stepper-nav>
        <x-ui.stepper-item :step="1">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
                <x-ui.stepper-title>Details</x-ui.stepper-title>
            </x-ui.stepper-trigger>
            <x-ui.stepper-separator />
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="2">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
                <x-ui.stepper-title>Confirm</x-ui.stepper-title>
            </x-ui.stepper-trigger>
            <x-ui.stepper-separator />
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="3">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
                <x-ui.stepper-title>Done</x-ui.stepper-title>
            </x-ui.stepper-trigger>
        </x-ui.stepper-item>
    </x-ui.stepper-nav>
</x-ui.stepper>
