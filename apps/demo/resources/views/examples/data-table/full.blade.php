@php($rows = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'amount' => '$1,200'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'amount' => '$840'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'amount' => '$2,100'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin', 'amount' => '$640'],
    ['id' => 5, 'name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member', 'amount' => '$1,950'],
    ['id' => 6, 'name' => 'Liam Johnson', 'email' => 'liam@example.com', 'role' => 'Member', 'amount' => '$320'],
])

{{-- Selection + search + sortable columns + row actions together — the full interactive table. --}}
<x-ui.data-table
    class="w-full max-w-2xl"
    row-key="id"
    search-placeholder="Filter members..."
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'amount', 'label' => 'Amount', 'class' => 'text-right'],
    ]"
    :rows="$rows"
    :page-size="5"
>
    <x-slot:actions>
        <x-ui.button size="sm" variant="ghost" x-on:click="$wire.edit(item.r.id)" aria-label="Edit row">
            <x-lucide-pencil class="size-4" aria-hidden="true" />
            <span class="sr-only sm:not-sr-only">Edit</span>
        </x-ui.button>
        <x-ui.button size="sm" variant="ghost" class="text-destructive hover:text-destructive" x-on:click="$wire.delete(item.r.id)" aria-label="Delete row">
            <x-lucide-trash-2 class="size-4" aria-hidden="true" />
            <span class="sr-only sm:not-sr-only">Delete</span>
        </x-ui.button>
    </x-slot:actions>
</x-ui.data-table>
