<x-ui.menubar>
    <x-ui.menubar-menu>
        <x-ui.menubar-trigger>File</x-ui.menubar-trigger>
        <x-ui.menubar-content>
            <x-ui.menubar-item>New Tab <x-ui.menubar-shortcut>⌘T</x-ui.menubar-shortcut></x-ui.menubar-item>
            <x-ui.menubar-item>New Window <x-ui.menubar-shortcut>⌘N</x-ui.menubar-shortcut></x-ui.menubar-item>
            <x-ui.menubar-item disabled>New Incognito Window</x-ui.menubar-item>
            <x-ui.menubar-separator />
            <x-ui.menubar-sub>
                <x-ui.menubar-sub-trigger>Share</x-ui.menubar-sub-trigger>
                <x-ui.menubar-sub-content>
                    <x-ui.menubar-item>Email link</x-ui.menubar-item>
                    <x-ui.menubar-item>Messages</x-ui.menubar-item>
                    <x-ui.menubar-item>Notes</x-ui.menubar-item>
                </x-ui.menubar-sub-content>
            </x-ui.menubar-sub>
            <x-ui.menubar-separator />
            <x-ui.menubar-item>Print... <x-ui.menubar-shortcut>⌘P</x-ui.menubar-shortcut></x-ui.menubar-item>
        </x-ui.menubar-content>
    </x-ui.menubar-menu>
    <x-ui.menubar-menu>
        <x-ui.menubar-trigger>Edit</x-ui.menubar-trigger>
        <x-ui.menubar-content>
            <x-ui.menubar-item>Undo <x-ui.menubar-shortcut>⌘Z</x-ui.menubar-shortcut></x-ui.menubar-item>
            <x-ui.menubar-item>Redo <x-ui.menubar-shortcut>⇧⌘Z</x-ui.menubar-shortcut></x-ui.menubar-item>
            <x-ui.menubar-separator />
            <x-ui.menubar-sub>
                <x-ui.menubar-sub-trigger>Find</x-ui.menubar-sub-trigger>
                <x-ui.menubar-sub-content>
                    <x-ui.menubar-item>Search the web</x-ui.menubar-item>
                    <x-ui.menubar-separator />
                    <x-ui.menubar-item>Find...</x-ui.menubar-item>
                    <x-ui.menubar-item>Find Next</x-ui.menubar-item>
                </x-ui.menubar-sub-content>
            </x-ui.menubar-sub>
            <x-ui.menubar-separator />
            <x-ui.menubar-item>Cut</x-ui.menubar-item>
            <x-ui.menubar-item>Copy</x-ui.menubar-item>
            <x-ui.menubar-item>Paste</x-ui.menubar-item>
        </x-ui.menubar-content>
    </x-ui.menubar-menu>
    <x-ui.menubar-menu>
        <x-ui.menubar-trigger>View</x-ui.menubar-trigger>
        <x-ui.menubar-content>
            <x-ui.menubar-checkbox-item :checked="true">Always Show Bookmarks Bar</x-ui.menubar-checkbox-item>
            <x-ui.menubar-checkbox-item>Always Show Full URLs</x-ui.menubar-checkbox-item>
            <x-ui.menubar-separator />
            <x-ui.menubar-item inset>Reload <x-ui.menubar-shortcut>⌘R</x-ui.menubar-shortcut></x-ui.menubar-item>
            <x-ui.menubar-item inset disabled>Force Reload</x-ui.menubar-item>
            <x-ui.menubar-separator />
            <x-ui.menubar-item inset>Toggle Fullscreen</x-ui.menubar-item>
        </x-ui.menubar-content>
    </x-ui.menubar-menu>
    <x-ui.menubar-menu>
        <x-ui.menubar-trigger>Profiles</x-ui.menubar-trigger>
        <x-ui.menubar-content>
            <x-ui.menubar-radio-group value="benoit">
                <x-ui.menubar-radio-item value="andy">Andy</x-ui.menubar-radio-item>
                <x-ui.menubar-radio-item value="benoit">Benoit</x-ui.menubar-radio-item>
                <x-ui.menubar-radio-item value="luis">Luis</x-ui.menubar-radio-item>
            </x-ui.menubar-radio-group>
            <x-ui.menubar-separator />
            <x-ui.menubar-item inset>Edit...</x-ui.menubar-item>
            <x-ui.menubar-separator />
            <x-ui.menubar-item inset>Add Profile...</x-ui.menubar-item>
        </x-ui.menubar-content>
    </x-ui.menubar-menu>
</x-ui.menubar>
