{{-- When :rows is empty, server-table shows a centered empty state. Customize emptyText / emptyIcon. --}}
<x-ui.server-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="[]"
    empty-text="No members match your filters."
    empty-icon="users"
    :actions="[
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
    ]"
/>
