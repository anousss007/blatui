{{-- A tooltip on a control that opens an overlay — the row-actions shape: an icon button
     that both explains itself on hover and asks for confirmation on click. The two have to
     hand off cleanly, because closing the dialog returns focus to the button underneath. --}}
<div class="flex items-center gap-2">
    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.alert-dialog-trigger for="tooltip-row-delete">
                <x-ui.button variant="ghost" size="icon" class="text-destructive" aria-label="Delete row">
                    <x-lucide-trash-2 aria-hidden="true" />
                </x-ui.button>
            </x-ui.alert-dialog-trigger>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content side="left">Delete</x-ui.tooltip-content>
    </x-ui.tooltip>

    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.button variant="ghost" size="icon" aria-label="Duplicate row">
                <x-lucide-copy aria-hidden="true" />
            </x-ui.button>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content>Duplicate</x-ui.tooltip-content>
    </x-ui.tooltip>
</div>

<x-ui.alert-dialog id="tooltip-row-delete">
    <x-ui.alert-dialog-content>
        <x-ui.alert-dialog-header>
            <x-ui.alert-dialog-title>Delete this row?</x-ui.alert-dialog-title>
            <x-ui.alert-dialog-description>
                This permanently deletes the row. This action cannot be undone.
            </x-ui.alert-dialog-description>
        </x-ui.alert-dialog-header>
        <x-ui.alert-dialog-footer>
            <x-ui.alert-dialog-cancel>Cancel</x-ui.alert-dialog-cancel>
            <x-ui.alert-dialog-action class="bg-destructive text-white shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive/20">Delete</x-ui.alert-dialog-action>
        </x-ui.alert-dialog-footer>
    </x-ui.alert-dialog-content>
</x-ui.alert-dialog>
