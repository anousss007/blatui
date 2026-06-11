{{-- Solid, filled alerts for high-emphasis messages. --}}
<div class="flex w-full max-w-xl flex-col gap-3">
    <x-ui.alert class="bg-primary text-primary-foreground border-none [&>svg]:text-primary-foreground">
        <x-lucide-info />
        <x-ui.alert-title>Editing your profile</x-ui.alert-title>
        <x-ui.alert-description class="text-primary-foreground">Changes won't be saved until you click "Update".</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert class="bg-success text-success-foreground border-none [&>svg]:text-success-foreground">
        <x-lucide-circle-check />
        <x-ui.alert-title>Payment received</x-ui.alert-title>
        <x-ui.alert-description class="text-success-foreground">Your subscription is now active.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert class="bg-warning text-warning-foreground border-none [&>svg]:text-warning-foreground">
        <x-lucide-triangle-alert />
        <x-ui.alert-title>Action required</x-ui.alert-title>
        <x-ui.alert-description class="text-warning-foreground">Confirm your email address to continue.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert class="bg-destructive border-none text-white [&>svg]:text-white">
        <x-lucide-circle-x />
        <x-ui.alert-title>Your session has expired</x-ui.alert-title>
        <x-ui.alert-description class="text-white">Please sign in again to continue.</x-ui.alert-description>
    </x-ui.alert>
</div>
