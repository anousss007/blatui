<div class="flex items-center justify-end gap-1">
    <x-ui.button size="sm" variant="ghost" x-on:click="$dispatch('brand-edit', { id: {{ $row['id'] }} })" aria-label="Edit brand" title="Edit brand" data-testid="edit-{{ $row['id'] }}">
        <x-lucide-pencil class="size-4" aria-hidden="true" />
    </x-ui.button>
    <x-ui.button size="sm" variant="ghost" class="text-destructive" aria-label="Delete brand"
        :title="$row['products_count'] > 0 ? 'Has '.$row['products_count'].' product(s)' : 'Delete brand'"
        :disabled="$row['products_count'] > 0"
        x-on:click="$dispatch('open-alert-dialog-delete-brand', { id: {{ $row['id'] }}, name: {{ \Illuminate\Support\Js::from($row['name']) }} })">
        <x-lucide-trash-2 class="size-4" aria-hidden="true" />
    </x-ui.button>
</div>
