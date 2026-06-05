<x-ui.card class="w-full max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Team members</x-ui.card-title>
        <x-ui.card-description>Invite your team to collaborate.</x-ui.card-description>
        <x-ui.card-action>
            <x-ui.dropdown-menu>
                <x-ui.dropdown-menu-trigger>
                    <x-ui.button variant="ghost" size="icon" aria-label="Card options">
                        <x-lucide-more-horizontal aria-hidden="true" />
                    </x-ui.button>
                </x-ui.dropdown-menu-trigger>
                <x-ui.dropdown-menu-content align="end">
                    <x-ui.dropdown-menu-item>Edit</x-ui.dropdown-menu-item>
                    <x-ui.dropdown-menu-item>Duplicate</x-ui.dropdown-menu-item>
                    <x-ui.dropdown-menu-separator />
                    <x-ui.dropdown-menu-item variant="destructive">Delete</x-ui.dropdown-menu-item>
                </x-ui.dropdown-menu-content>
            </x-ui.dropdown-menu>
        </x-ui.card-action>
    </x-ui.card-header>
    <x-ui.card-content class="flex flex-col gap-4">
        <div class="flex items-center gap-3">
            <x-ui.avatar>
                <x-ui.avatar-fallback>SC</x-ui.avatar-fallback>
            </x-ui.avatar>
            <div class="flex-1 text-sm">
                <div class="font-medium">Sofia Carter</div>
                <div class="text-muted-foreground">sofia@example.com</div>
            </div>
            <x-ui.badge variant="outline">Owner</x-ui.badge>
        </div>
        <div class="flex items-center gap-3">
            <x-ui.avatar>
                <x-ui.avatar-fallback>JD</x-ui.avatar-fallback>
            </x-ui.avatar>
            <div class="flex-1 text-sm">
                <div class="font-medium">Jackson Doe</div>
                <div class="text-muted-foreground">jackson@example.com</div>
            </div>
            <x-ui.badge variant="outline">Member</x-ui.badge>
        </div>
    </x-ui.card-content>
</x-ui.card>
