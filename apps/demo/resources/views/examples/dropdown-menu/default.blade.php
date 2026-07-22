<x-ui.dropdown-menu>
    <x-ui.dropdown-menu-trigger>
        <x-ui.button variant="outline">Open</x-ui.button>
    </x-ui.dropdown-menu-trigger>
    <x-ui.dropdown-menu-content class="w-56" align="start">
        <x-ui.dropdown-menu-label>My Account</x-ui.dropdown-menu-label>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-group>
            <x-ui.dropdown-menu-item>
                Profile
                <x-ui.dropdown-menu-shortcut>⇧⌘P</x-ui.dropdown-menu-shortcut>
            </x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item>
                Billing
                <x-ui.dropdown-menu-shortcut>⌘B</x-ui.dropdown-menu-shortcut>
            </x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item>
                Settings
                <x-ui.dropdown-menu-shortcut>⌘S</x-ui.dropdown-menu-shortcut>
            </x-ui.dropdown-menu-item>
        </x-ui.dropdown-menu-group>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-item>
            Log out
            <x-ui.dropdown-menu-shortcut>⇧⌘Q</x-ui.dropdown-menu-shortcut>
        </x-ui.dropdown-menu-item>
    </x-ui.dropdown-menu-content>
</x-ui.dropdown-menu>
