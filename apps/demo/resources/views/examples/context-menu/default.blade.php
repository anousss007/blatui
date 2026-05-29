<x-ui.context-menu>
    <x-ui.context-menu-trigger class="border-input flex h-[150px] w-[300px] items-center justify-center rounded-md border border-dashed text-sm">
        Right click here
    </x-ui.context-menu-trigger>
    <x-ui.context-menu-content class="w-52">
        <x-ui.context-menu-item inset>
            Back
            <x-ui.context-menu-shortcut>⌘[</x-ui.context-menu-shortcut>
        </x-ui.context-menu-item>
        <x-ui.context-menu-item inset disabled>
            Forward
            <x-ui.context-menu-shortcut>⌘]</x-ui.context-menu-shortcut>
        </x-ui.context-menu-item>
        <x-ui.context-menu-item inset>
            Reload
            <x-ui.context-menu-shortcut>⌘R</x-ui.context-menu-shortcut>
        </x-ui.context-menu-item>
        <x-ui.context-menu-separator />
        <x-ui.context-menu-checkbox-item :checked="true">
            Show Bookmarks Bar
            <x-ui.context-menu-shortcut>⌘⇧B</x-ui.context-menu-shortcut>
        </x-ui.context-menu-checkbox-item>
        <x-ui.context-menu-checkbox-item>Show Full URLs</x-ui.context-menu-checkbox-item>
        <x-ui.context-menu-separator />
        <x-ui.context-menu-label inset>People</x-ui.context-menu-label>
        <x-ui.context-menu-radio-group value="pedro">
            <x-ui.context-menu-radio-item value="pedro">Pedro Duarte</x-ui.context-menu-radio-item>
            <x-ui.context-menu-radio-item value="colm">Colm Tuite</x-ui.context-menu-radio-item>
        </x-ui.context-menu-radio-group>
    </x-ui.context-menu-content>
</x-ui.context-menu>
