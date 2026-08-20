@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'status' => 'Invited'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'status' => 'Active'],
])

{{--
    The toolbar slot is the escape hatch beside the search box: put any filter you like in it —
    a status select, a date-range picker, a bulk-action button — bound to your own Livewire
    properties. Props will never cover every filtering case, so this is the one that does.
    Inert in this static preview.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    searchable
    search-model="search"
    search-placeholder="Search members..."
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'status', 'label' => 'Status'],
    ]"
    :rows="$users"
>
    <x-slot:toolbar>
        <x-ui.select
            wire:model.live="status"
            :options="['' => 'All statuses', 'active' => 'Active', 'invited' => 'Invited']"
            size="sm"
            class="w-40"
            aria-label="Filter by status"
        />
    </x-slot:toolbar>
</x-ui.server-table>
