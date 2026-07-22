{{--
    Custom actions partial — included once per row by server-table with the real $row model in
    scope. Because it is rendered server-side, native wire:click with the model's key works here.
--}}
<div class="flex items-center justify-end gap-1">
    <x-ui.button size="sm" variant="ghost" wire:click="edit({{ $row['id'] }})">
        <x-lucide-pencil class="size-4" aria-hidden="true" />
        <span class="sr-only sm:not-sr-only">Edit</span>
    </x-ui.button>
    <x-ui.button size="sm" variant="ghost" class="text-destructive hover:text-destructive"
        wire:click="delete({{ $row['id'] }})"
        wire:confirm="Delete {{ $row['name'] }}?">
        <x-lucide-trash-2 class="size-4" aria-hidden="true" />
        <span class="sr-only">Delete {{ $row['name'] }}</span>
    </x-ui.button>
</div>
