<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline">Delete account</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content class="sm:max-w-[425px]">
        <x-ui.dialog-header>
            <x-ui.dialog-title>Are you absolutely sure?</x-ui.dialog-title>
            <x-ui.dialog-description>
                This action cannot be undone. This will permanently delete your account and remove your data from our servers.
            </x-ui.dialog-description>
        </x-ui.dialog-header>
        <x-ui.dialog-footer>
            <x-ui.dialog-close>
                <x-ui.button variant="outline">Cancel</x-ui.button>
            </x-ui.dialog-close>
            <x-ui.button variant="destructive">Delete account</x-ui.button>
        </x-ui.dialog-footer>
    </x-ui.dialog-content>
</x-ui.dialog>
