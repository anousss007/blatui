@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'team' => 'Design', 'location' => 'Lisbon', 'joined' => '2023-01-12'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'team' => 'Engineering', 'location' => 'Berlin', 'joined' => '2023-03-04'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'team' => 'Marketing', 'location' => 'Toronto', 'joined' => '2022-11-21'],
])

{{--
    With many columns the table scrolls horizontally on narrow screens. stickyActions freezes the
    actions column to the right edge so the controls stay reachable. Scroll the table sideways.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    sticky-actions
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'team', 'label' => 'Team'],
        ['key' => 'location', 'label' => 'Location'],
        ['key' => 'joined', 'label' => 'Joined'],
    ]"
    :rows="$users"
    :actions="[
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
        ['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'class' => 'text-destructive hover:text-destructive', 'confirm' => 'Delete this user?'],
    ]"
/>
