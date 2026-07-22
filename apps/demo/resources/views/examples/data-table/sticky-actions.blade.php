@php($rows = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'team' => 'Design', 'location' => 'Lisbon'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'team' => 'Engineering', 'location' => 'Berlin'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'team' => 'Marketing', 'location' => 'Toronto'],
])

{{-- stickyActions freezes the actions column to the right edge while the table scrolls sideways. --}}
<x-ui.data-table
    class="w-full max-w-2xl"
    row-key="id"
    :selectable="false"
    :searchable="false"
    sticky-actions
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'team', 'label' => 'Team'],
        ['key' => 'location', 'label' => 'Location'],
    ]"
    :rows="$rows"
>
    <x-slot:actions>
        <x-ui.button size="sm" variant="ghost" x-on:click="$wire.edit(item.r.id)" aria-label="Edit row">
            <x-lucide-pencil class="size-4" aria-hidden="true" />
        </x-ui.button>
        <x-ui.button size="sm" variant="ghost" class="text-destructive hover:text-destructive" x-on:click="$wire.delete(item.r.id)" aria-label="Delete row">
            <x-lucide-trash-2 class="size-4" aria-hidden="true" />
        </x-ui.button>
    </x-slot:actions>
</x-ui.data-table>
