<x-ui.alert-dialog>
    <x-ui.alert-dialog-trigger>
        <x-ui.button variant="destructive">Delete project</x-ui.button>
    </x-ui.alert-dialog-trigger>
    <x-ui.alert-dialog-content>
        <x-ui.alert-dialog-header>
            <x-ui.alert-dialog-title>Delete this project?</x-ui.alert-dialog-title>
            <x-ui.alert-dialog-description>
                This permanently deletes the project and all of its data. This action cannot be undone.
            </x-ui.alert-dialog-description>
        </x-ui.alert-dialog-header>
        <x-ui.alert-dialog-footer>
            <x-ui.alert-dialog-cancel>Cancel</x-ui.alert-dialog-cancel>
            <x-ui.alert-dialog-action class="bg-destructive text-white shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive/20">Delete</x-ui.alert-dialog-action>
        </x-ui.alert-dialog-footer>
    </x-ui.alert-dialog-content>
</x-ui.alert-dialog>
