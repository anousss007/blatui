<x-ui.tabs value="account" class="w-full max-w-md">
    <x-ui.tabs-list class="grid w-full grid-cols-3">
        <x-ui.tabs-trigger value="account">Account</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="password">Password</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="team" disabled>Team</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <x-ui.tabs-content value="account" class="text-muted-foreground text-sm">Manage your account settings and preferences.</x-ui.tabs-content>
    <x-ui.tabs-content value="password" class="text-muted-foreground text-sm">Change your password and security options.</x-ui.tabs-content>
</x-ui.tabs>
