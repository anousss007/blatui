@php($rows = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
    ['id' => 5, 'name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member'],
])

{{--
    The `actions` slot renders inside the client-side x-for, so the current row is `item.r`.
    Bind to Livewire with $wire (shown below). In this static preview there is no Livewire
    runtime, so the clicks are inert — copy this into a Livewire component to wire them up.
--}}
<x-ui.data-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$rows"
    row-key="id"
    :selectable="false"
    :searchable="false"
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
