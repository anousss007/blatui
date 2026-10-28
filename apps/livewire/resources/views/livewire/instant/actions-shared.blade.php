<div class="flex items-center justify-end gap-1">
    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.button size="sm" variant="ghost" x-on:click="$dispatch('brand-edit', { id: {{ $row['id'] }} })" aria-label="Edit brand" data-testid="edit-{{ $row['id'] }}">
                <x-lucide-pencil class="size-4" aria-hidden="true" />
            </x-ui.button>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content side="left">Edit brand</x-ui.tooltip-content>
    </x-ui.tooltip>
    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.button size="sm" variant="ghost" class="text-destructive" aria-label="Delete brand"
                :disabled="$row['products_count'] > 0"
                x-on:click="$dispatch('open-alert-dialog-delete-brand', { id: {{ $row['id'] }}, name: {{ \Illuminate\Support\Js::from($row['name']) }} })">
                <x-lucide-trash-2 class="size-4" aria-hidden="true" />
            </x-ui.button>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content side="left">{{ $row['products_count'] > 0 ? "Has {$row['products_count']} product(s)" : 'Delete brand' }}</x-ui.tooltip-content>
    </x-ui.tooltip>
</div>
