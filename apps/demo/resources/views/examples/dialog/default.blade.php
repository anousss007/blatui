<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline">Edit Profile</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content class="sm:max-w-[425px]">
        <x-ui.dialog-header>
            <x-ui.dialog-title>Edit profile</x-ui.dialog-title>
            <x-ui.dialog-description>
                Make changes to your profile here. Click save when you're done.
            </x-ui.dialog-description>
        </x-ui.dialog-header>
        <div class="grid gap-4 py-2">
            <div class="grid gap-2">
                <x-ui.label for="name">Name</x-ui.label>
                <x-ui.input id="name" value="Pedro Duarte" />
            </div>
            <div class="grid gap-2">
                <x-ui.label for="username">Username</x-ui.label>
                <x-ui.input id="username" value="@peduarte" />
            </div>
        </div>
        <x-ui.dialog-footer>
            <x-ui.button type="submit">Save changes</x-ui.button>
        </x-ui.dialog-footer>
    </x-ui.dialog-content>
</x-ui.dialog>
