{{-- Title plus a secondary description per step. --}}
<x-ui.stepper :value="2" class="w-full max-w-3xl">
    <x-ui.stepper-nav>
        <x-ui.stepper-item :step="1">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
                <span class="flex flex-col gap-0.5">
                    <x-ui.stepper-title>Account</x-ui.stepper-title>
                    <x-ui.stepper-description>Create an account</x-ui.stepper-description>
                </span>
            </x-ui.stepper-trigger>
            <x-ui.stepper-separator />
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="2">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
                <span class="flex flex-col gap-0.5">
                    <x-ui.stepper-title>Profile</x-ui.stepper-title>
                    <x-ui.stepper-description>Set up your profile</x-ui.stepper-description>
                </span>
            </x-ui.stepper-trigger>
            <x-ui.stepper-separator />
        </x-ui.stepper-item>
        <x-ui.stepper-item :step="3">
            <x-ui.stepper-trigger>
                <x-ui.stepper-indicator />
                <span class="flex flex-col gap-0.5">
                    <x-ui.stepper-title>Complete</x-ui.stepper-title>
                    <x-ui.stepper-description>Finish the setup</x-ui.stepper-description>
                </span>
            </x-ui.stepper-trigger>
        </x-ui.stepper-item>
    </x-ui.stepper-nav>
</x-ui.stepper>
