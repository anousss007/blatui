<x-ui.dropdown-menu>
    <x-ui.dropdown-menu-trigger>
        <x-ui.button variant="outline">Open</x-ui.button>
    </x-ui.dropdown-menu-trigger>
    <x-ui.dropdown-menu-content class="w-56" align="start">
        <x-ui.dropdown-menu-label>Appearance</x-ui.dropdown-menu-label>
        <x-ui.dropdown-menu-separator />
        <x-ui.dropdown-menu-checkbox-item :checked="true">Status Bar</x-ui.dropdown-menu-checkbox-item>
        <x-ui.dropdown-menu-checkbox-item disabled>Activity Bar</x-ui.dropdown-menu-checkbox-item>
        <x-ui.dropdown-menu-checkbox-item>Panel</x-ui.dropdown-menu-checkbox-item>
    </x-ui.dropdown-menu-content>
</x-ui.dropdown-menu>
