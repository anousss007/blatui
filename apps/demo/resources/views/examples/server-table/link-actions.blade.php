@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
])

{{--
    Actions can navigate instead of calling a method. Use `href` — a string with {id} substituted,
    or a closure fn ($row) => route(...). `iconOnly` keeps the button compact (label stays as an
    aria-label). Here: a link View, an icon-only Edit, and a method-based Delete.
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
        ['label' => 'View', 'icon' => 'external-link', 'href' => '/users/{id}'],
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit', 'iconOnly' => true],
        ['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'iconOnly' => true, 'class' => 'text-destructive hover:text-destructive', 'confirm' => 'Delete this user?'],
    ]"
/>
