@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
])

{{-- variant="card" wraps the table in an elevated card surface. --}}
<x-ui.server-table
    class="w-full max-w-2xl"
    variant="card"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
    :actions="[
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
    ]"
/>
