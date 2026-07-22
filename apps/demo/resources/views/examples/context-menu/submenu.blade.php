<x-ui.context-menu>
    <x-ui.context-menu-trigger class="border-input flex h-[150px] w-[300px] items-center justify-center rounded-md border border-dashed text-sm">
        Right click here
    </x-ui.context-menu-trigger>
    <x-ui.context-menu-content class="w-52">
        <x-ui.context-menu-item>Back</x-ui.context-menu-item>
        <x-ui.context-menu-item>Reload</x-ui.context-menu-item>
        <x-ui.context-menu-sub>
            <x-ui.context-menu-sub-trigger>More tools</x-ui.context-menu-sub-trigger>
            <x-ui.context-menu-sub-content class="w-44">
                <x-ui.context-menu-item>Save page as…</x-ui.context-menu-item>
                <x-ui.context-menu-item>Create shortcut…</x-ui.context-menu-item>
                <x-ui.context-menu-separator />
                <x-ui.context-menu-item>Developer tools</x-ui.context-menu-item>
            </x-ui.context-menu-sub-content>
        </x-ui.context-menu-sub>
        <x-ui.context-menu-separator />
        <x-ui.context-menu-item>View source</x-ui.context-menu-item>
    </x-ui.context-menu-content>
</x-ui.context-menu>
