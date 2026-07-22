{{-- Leading icons inside the triggers. --}}
<x-ui.tabs value="account" class="w-full max-w-md">
    <x-ui.tabs-list>
        <x-ui.tabs-trigger value="account"><x-lucide-user /> Account</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="billing"><x-lucide-credit-card /> Billing</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="settings"><x-lucide-settings /> Settings</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <x-ui.tabs-content value="account" class="text-muted-foreground text-sm">Manage your profile and personal details.</x-ui.tabs-content>
    <x-ui.tabs-content value="billing" class="text-muted-foreground text-sm">Update payment methods and view invoices.</x-ui.tabs-content>
    <x-ui.tabs-content value="settings" class="text-muted-foreground text-sm">Configure preferences and notifications.</x-ui.tabs-content>
</x-ui.tabs>
