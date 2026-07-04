@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
])

{{--
    Show an action only for some rows with a `visible` predicate — fn ($row) => bool. Here Delete
    is hidden for Owners, so the destructive control never appears where it shouldn't. Great for
    per-row permissions (e.g. auth()->user()->can('delete', $row)).
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
    :actions="[
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
        [
            'label' => 'Delete',
            'icon' => 'trash-2',
            'method' => 'delete',
            'class' => 'text-destructive hover:text-destructive',
            'confirm' => 'Delete this user?',
            'visible' => fn ($row) => $row['role'] !== 'Owner',
        ],
    ]"
/>
