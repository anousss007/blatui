<x-ui.sheet>
    <x-ui.sheet-trigger>
        <x-ui.button variant="outline">Open</x-ui.button>
    </x-ui.sheet-trigger>
    <x-ui.sheet-content side="right">
        <x-ui.sheet-header>
            <x-ui.sheet-title>Edit profile</x-ui.sheet-title>
            <x-ui.sheet-description>
                Make changes to your profile here. Click save when you're done.
            </x-ui.sheet-description>
        </x-ui.sheet-header>
        <div class="grid flex-1 auto-rows-min gap-6 px-4">
            <div class="grid gap-2">
                <x-ui.label for="sheet-name">Name</x-ui.label>
                <x-ui.input id="sheet-name" value="Pedro Duarte" />
            </div>
            <div class="grid gap-2">
                <x-ui.label for="sheet-username">Username</x-ui.label>
                <x-ui.input id="sheet-username" value="@peduarte" />
            </div>
        </div>
        <x-ui.sheet-footer>
            <x-ui.button type="submit">Save changes</x-ui.button>
            <x-ui.button variant="outline" class="w-full" x-on:click="open = false">Close</x-ui.button>
        </x-ui.sheet-footer>
    </x-ui.sheet-content>
</x-ui.sheet>
