{{-- Numbered steps with Previous / Next controls. Completed steps show a check. --}}
<x-ui.stepper :value="1" class="w-full max-w-xl">
    <x-ui.stepper-nav>
        <x-ui.stepper-item :step="1">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
            </x-ui.stepper-trigger>
            <x-ui.stepper-separator />
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="2">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
            </x-ui.stepper-trigger>
            <x-ui.stepper-separator />
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="3">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
            </x-ui.stepper-trigger>
        </x-ui.stepper-item>
    </x-ui.stepper-nav>

    <div class="text-muted-foreground flex h-32 items-center justify-center rounded-md border text-sm">
        <span x-text="`Step ${step} of 3`"></span>
    </div>

    <div class="flex justify-between">
        <x-ui.button variant="outline" x-bind:disabled="step === 1" x-on:click="step = Math.max(1, step - 1)">Previous</x-ui.button>
        <x-ui.button x-bind:disabled="step === 3" x-on:click="step = Math.min(3, step + 1)">Next</x-ui.button>
    </div>
</x-ui.stepper>
