@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member'],
    ['id' => 5, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
])

{{--
    Sortable headers emit wire:click="sortBy('key')". Bind :sort / :direction to Livewire props
    and order your query there — the header chevron and aria-sort follow the current state.
    Here they are set statically to show the active "Name ▲" state.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
    sort="name"
    direction="asc"
    sort-method="sortBy"
/>
