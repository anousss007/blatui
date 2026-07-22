@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
])

{{-- With many actions, collapse them into an overflow "…" menu — tidier on narrow screens. --}}
<x-ui.server-table
    class="w-full max-w-2xl"
    actions-mode="dropdown"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
    :actions="[
        ['label' => 'View', 'icon' => 'eye', 'method' => 'view'],
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
        ['label' => 'Duplicate', 'icon' => 'copy', 'method' => 'duplicate'],
        ['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'variant' => 'destructive', 'confirm' => 'Delete this user?'],
    ]"
/>
