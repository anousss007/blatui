<x-ui.dropdown-menu>
    <x-ui.dropdown-menu-trigger>
        <x-ui.button variant="outline">Account</x-ui.button>
    </x-ui.dropdown-menu-trigger>
    <x-ui.dropdown-menu-content class="w-56" align="start">
        <x-ui.dropdown-menu-label>My Account</x-ui.dropdown-menu-label>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-group>
            <x-ui.dropdown-menu-item><x-lucide-user aria-hidden="true" /> Profile <x-ui.dropdown-menu-shortcut>⇧⌘P</x-ui.dropdown-menu-shortcut></x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item><x-lucide-credit-card aria-hidden="true" /> Billing <x-ui.dropdown-menu-shortcut>⌘B</x-ui.dropdown-menu-shortcut></x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item><x-lucide-settings aria-hidden="true" /> Settings <x-ui.dropdown-menu-shortcut>⌘S</x-ui.dropdown-menu-shortcut></x-ui.dropdown-menu-item>
        </x-ui.dropdown-menu-group>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-item><x-lucide-github aria-hidden="true" /> GitHub</x-ui.dropdown-menu-item>
        <x-ui.dropdown-menu-item><x-lucide-life-buoy aria-hidden="true" /> Support</x-ui.dropdown-menu-item>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-item variant="destructive"><x-lucide-log-out aria-hidden="true" /> Log out <x-ui.dropdown-menu-shortcut>⇧⌘Q</x-ui.dropdown-menu-shortcut></x-ui.dropdown-menu-item>
    </x-ui.dropdown-menu-content>
</x-ui.dropdown-menu>
