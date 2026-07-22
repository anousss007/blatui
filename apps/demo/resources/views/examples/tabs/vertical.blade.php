<x-ui.tabs value="general" orientation="vertical" class="w-full max-w-xl flex-row gap-4">
    <x-ui.tabs-list class="h-auto flex-col">
        <x-ui.tabs-trigger value="general" class="w-full justify-start">General</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="security" class="w-full justify-start">Security</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="integrations" class="w-full justify-start">Integrations</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <div class="flex-1">
        <x-ui.tabs-content value="general" class="text-muted-foreground mt-0 text-sm">Manage your general workspace preferences.</x-ui.tabs-content>
        <x-ui.tabs-content value="security" class="text-muted-foreground mt-0 text-sm">Configure authentication and access control.</x-ui.tabs-content>
        <x-ui.tabs-content value="integrations" class="text-muted-foreground mt-0 text-sm">Connect third-party services and webhooks.</x-ui.tabs-content>
    </div>
</x-ui.tabs>
