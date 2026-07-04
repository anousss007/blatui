@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'status' => 'Invited'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'status' => 'Suspended'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin', 'status' => 'Active'],
])

{{--
    Render any column with your own Blade via `cell-views`: a map of column key => view. Each view
    is included with $value (the cell value) and $row (the model) in scope — here a rich name/avatar
    cell and a status badge. Perfect for badges, avatars, links, money and dates.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Member'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'status', 'label' => 'Status'],
    ]"
    :rows="$users"
    :cell-views="[
        'name' => 'examples.server-table.partials.user-cell',
        'status' => 'examples.server-table.partials.status',
    ]"
    :actions="[
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
    ]"
/>
