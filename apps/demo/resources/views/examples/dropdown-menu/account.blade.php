{{-- Avatar-triggered account menu with a user header. --}}
<x-ui.dropdown-menu>
    <x-ui.dropdown-menu-trigger>
        <x-ui.button variant="ghost" class="size-9 rounded-full p-0" aria-label="Open account menu">
            <x-ui.avatar class="size-9">
                <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
                <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
            </x-ui.avatar>
        </x-ui.button>
    </x-ui.dropdown-menu-trigger>
    <x-ui.dropdown-menu-content class="w-56" align="end">
        <x-ui.dropdown-menu-label class="font-normal">
            <div class="flex flex-col space-y-0.5">
                <span class="text-sm font-medium">shadcn</span>
                <span class="text-muted-foreground text-xs">m@example.com</span>
            </div>
        </x-ui.dropdown-menu-label>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-group>
            <x-ui.dropdown-menu-item><x-lucide-user aria-hidden="true" /> Profile</x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item><x-lucide-credit-card aria-hidden="true" /> Billing</x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item><x-lucide-settings aria-hidden="true" /> Settings</x-ui.dropdown-menu-item>
        </x-ui.dropdown-menu-group>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-item variant="destructive"><x-lucide-log-out aria-hidden="true" /> Log out</x-ui.dropdown-menu-item>
    </x-ui.dropdown-menu-content>
</x-ui.dropdown-menu>
