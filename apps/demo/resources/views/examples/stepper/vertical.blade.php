{{-- Vertical orientation: indicators stacked with a growing rail between them. --}}
<x-ui.stepper :value="2" orientation="vertical" class="w-full max-w-md">
    <x-ui.stepper-nav>
        <x-ui.stepper-item :step="1">
            <x-ui.stepper-trigger class="items-start">
                <span class="flex flex-col items-center self-stretch">
                    <x-ui.stepper-indicator />
                    <x-ui.stepper-separator />
                </span>
                <span class="flex flex-col gap-0.5 pt-1.5 pb-6">
                    <x-ui.stepper-title>Account</x-ui.stepper-title>
                    <x-ui.stepper-description>Create your account</x-ui.stepper-description>
                </span>
            </x-ui.stepper-trigger>
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="2">
            <x-ui.stepper-trigger class="items-start">
                <span class="flex flex-col items-center self-stretch">
                    <x-ui.stepper-indicator />
                    <x-ui.stepper-separator />
                </span>
                <span class="flex flex-col gap-0.5 pt-1.5 pb-6">
                    <x-ui.stepper-title>Profile</x-ui.stepper-title>
                    <x-ui.stepper-description>Set up your profile</x-ui.stepper-description>
                </span>
            </x-ui.stepper-trigger>
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="3">
            <x-ui.stepper-trigger class="items-start">
                <span class="flex flex-col items-center self-stretch">
                    <x-ui.stepper-indicator />
                </span>
                <span class="flex flex-col gap-0.5 pt-1.5">
                    <x-ui.stepper-title>Complete</x-ui.stepper-title>
                    <x-ui.stepper-description>Finish the setup</x-ui.stepper-description>
                </span>
            </x-ui.stepper-trigger>
        </x-ui.stepper-item>
    </x-ui.stepper-nav>
</x-ui.stepper>
