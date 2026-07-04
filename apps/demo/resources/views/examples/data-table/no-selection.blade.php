@php($rows = [
    ['name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'amount' => '$1,200'],
    ['name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'amount' => '$840'],
    ['name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'amount' => '$2,100'],
    ['name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin', 'amount' => '$640'],
    ['name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member', 'amount' => '$1,950'],
])

{{-- selectable="false" drops the checkbox column; the footer then reports the result count. --}}
<x-ui.data-table
    class="w-full max-w-2xl"
    :selectable="false"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'amount', 'label' => 'Amount', 'class' => 'text-right'],
    ]"
    :rows="$rows"
    :page-size="5"
/>
