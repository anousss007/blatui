@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'status' => 'Invited'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'status' => 'Suspended'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin', 'status' => 'Active'],
])

{{--
    Everything at once: a card surface, search, row selection, sortable columns, a custom status
    cell, and a dropdown of row actions (with a permission-gated Delete). This is the shape of a
    real CRUD admin table — drop it into a Livewire component and wire the methods.
--}}
<x-ui.server-table
    class="w-full max-w-3xl"
    variant="card"
    searchable
    selectable
    actions-mode="dropdown"
    sort="name"
    direction="asc"
    caption="Team members"
    :columns="[
        ['key' => 'name', 'label' => 'Member', 'sortable' => true],
        ['key' => 'role', 'label' => 'Role', 'sortable' => true],
        ['key' => 'status', 'label' => 'Status', 'align' => 'center'],
    ]"
    :rows="$users"
    :cell-views="[
        'name' => 'examples.server-table.partials.user-cell',
        'status' => 'examples.server-table.partials.status',
    ]"
    :actions="[
        ['label' => 'View', 'icon' => 'eye', 'href' => '/users/{id}'],
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
        ['label' => 'Duplicate', 'icon' => 'copy', 'method' => 'duplicate'],
        ['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'variant' => 'destructive', 'confirm' => 'Delete this user?', 'visible' => fn ($row) => $row['role'] !== 'Owner'],
    ]"
/>
