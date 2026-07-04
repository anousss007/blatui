@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
])

{{--
    Declarative row actions. Each renders server-side with a native wire:click carrying the real
    primary key — wire:click="edit(1)", wire:click="delete(1)" — so no client-side plumbing is
    needed. `confirm` adds a wire:confirm prompt before the action runs.
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
        ['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'class' => 'text-destructive hover:text-destructive', 'confirm' => 'Delete this user?'],
    ]"
/>
