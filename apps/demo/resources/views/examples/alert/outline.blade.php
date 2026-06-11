{{-- Outlined alerts: coloured border + text on the card background. --}}
<div class="flex w-full max-w-xl flex-col gap-3">
    <x-ui.alert class="border-info text-info bg-card [&>svg]:text-info">
        <x-lucide-info />
        <x-ui.alert-title>A new software update is available</x-ui.alert-title>
        <x-ui.alert-description class="text-info">Version 2.4 is ready to install.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert class="border-success text-success bg-card [&>svg]:text-success">
        <x-lucide-circle-check />
        <x-ui.alert-title>Changes saved successfully</x-ui.alert-title>
        <x-ui.alert-description class="text-success">Your profile has been updated.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert class="border-warning text-warning bg-card [&>svg]:text-warning">
        <x-lucide-triangle-alert />
        <x-ui.alert-title>Your storage is almost full</x-ui.alert-title>
        <x-ui.alert-description class="text-warning">You've used 90% of your quota.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert class="border-destructive text-destructive bg-card [&>svg]:text-destructive">
        <x-lucide-circle-x />
        <x-ui.alert-title>Something went wrong</x-ui.alert-title>
        <x-ui.alert-description class="text-destructive">Please try again in a few minutes.</x-ui.alert-description>
    </x-ui.alert>
</div>
