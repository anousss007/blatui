<div class="flex items-center justify-end gap-1">
    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.button size="sm" variant="ghost" x-on:click="$dispatch('brand-edit', { id: {{ $row['id'] }} })" aria-label="Edit brand" data-testid="edit-{{ $row['id'] }}">
                <x-lucide-pencil class="size-4" aria-hidden="true" />
            </x-ui.button>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content side="left">Edit brand</x-ui.tooltip-content>
    </x-ui.tooltip>
    @if ($row['products_count'] > 0)
        <x-ui.tooltip>
            <x-ui.tooltip-trigger>
                <x-ui.button size="sm" variant="ghost" class="text-destructive" aria-label="Delete brand" disabled>
                    <x-lucide-trash-2 class="size-4" aria-hidden="true" />
                </x-ui.button>
            </x-ui.tooltip-trigger>
            <x-ui.tooltip-content side="left">Has {{ $row['products_count'] }} product(s)</x-ui.tooltip-content>
        </x-ui.tooltip>
    @else
        <x-ui.alert-dialog class="contents">
            <x-ui.alert-dialog-trigger>
                <x-ui.tooltip>
                    <x-ui.tooltip-trigger>
                        <x-ui.button size="sm" variant="ghost" class="text-destructive" aria-label="Delete brand">
                            <x-lucide-trash-2 class="size-4" aria-hidden="true" />
                        </x-ui.button>
                    </x-ui.tooltip-trigger>
                    <x-ui.tooltip-content side="left">Delete brand</x-ui.tooltip-content>
                </x-ui.tooltip>
            </x-ui.alert-dialog-trigger>
            <x-ui.alert-dialog-content>
                <x-ui.alert-dialog-header>
                    <x-ui.alert-dialog-title>Delete "{{ $row['name'] }}"?</x-ui.alert-dialog-title>
                    <x-ui.alert-dialog-description>"{{ $row['name'] }}" will be deleted permanently.</x-ui.alert-dialog-description>
                </x-ui.alert-dialog-header>
                <x-ui.alert-dialog-footer>
                    <x-ui.alert-dialog-cancel>Cancel</x-ui.alert-dialog-cancel>
                    <x-ui.alert-dialog-action wire:click="delete({{ $row['id'] }})" wire:loading.attr="disabled" wire:target="delete({{ $row['id'] }})">
                        <x-lucide-trash-2 aria-hidden="true" />
                        Delete
                    </x-ui.alert-dialog-action>
                </x-ui.alert-dialog-footer>
            </x-ui.alert-dialog-content>
        </x-ui.alert-dialog>
    @endif
</div>
