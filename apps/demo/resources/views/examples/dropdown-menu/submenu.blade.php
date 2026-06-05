<x-ui.dropdown-menu>
    <x-ui.dropdown-menu-trigger>
        <x-ui.button variant="outline">Open</x-ui.button>
    </x-ui.dropdown-menu-trigger>
    <x-ui.dropdown-menu-content class="w-56" align="start">
        <x-ui.dropdown-menu-item><x-lucide-user aria-hidden="true" /> Profile</x-ui.dropdown-menu-item>
        <x-ui.dropdown-menu-sub>
            <x-ui.dropdown-menu-sub-trigger><x-lucide-user-plus aria-hidden="true" /> Invite users</x-ui.dropdown-menu-sub-trigger>
            <x-ui.dropdown-menu-sub-content>
                <x-ui.dropdown-menu-item><x-lucide-mail aria-hidden="true" /> Email</x-ui.dropdown-menu-item>
                <x-ui.dropdown-menu-item><x-lucide-message-square aria-hidden="true" /> Message</x-ui.dropdown-menu-item>
                <x-ui.dropdown-menu-separator />
                <x-ui.dropdown-menu-item><x-lucide-plus-circle aria-hidden="true" /> More…</x-ui.dropdown-menu-item>
            </x-ui.dropdown-menu-sub-content>
        </x-ui.dropdown-menu-sub>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-item><x-lucide-settings aria-hidden="true" /> Settings</x-ui.dropdown-menu-item>
    </x-ui.dropdown-menu-content>
</x-ui.dropdown-menu>
