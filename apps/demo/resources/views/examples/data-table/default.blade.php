@php($rows = [
    ['name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'amount' => '$1,200'],
    ['name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'amount' => '$840'],
    ['name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'amount' => '$2,100'],
    ['name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin', 'amount' => '$640'],
    ['name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member', 'amount' => '$1,950'],
    ['name' => 'Liam Johnson', 'email' => 'liam@example.com', 'role' => 'Member', 'amount' => '$320'],
    ['name' => 'Emma Brown', 'email' => 'emma@example.com', 'role' => 'Admin', 'amount' => '$5,400'],
    ['name' => 'Noah Wilson', 'email' => 'noah@example.com', 'role' => 'Member', 'amount' => '$1,100'],
    ['name' => 'Ava Garcia', 'email' => 'ava@example.com', 'role' => 'Member', 'amount' => '$760'],
    ['name' => 'Mason Lopez', 'email' => 'mason@example.com', 'role' => 'Owner', 'amount' => '$3,300'],
    ['name' => 'Mia Hernandez', 'email' => 'mia@example.com', 'role' => 'Member', 'amount' => '$220'],
    ['name' => 'Lucas Young', 'email' => 'lucas@example.com', 'role' => 'Member', 'amount' => '$1,480'],
])

<x-ui.data-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'amount', 'label' => 'Amount', 'class' => 'text-right'],
    ]"
    :rows="$rows"
    search-key="name"
    search-placeholder="Filter names..."
    :page-size="5"
/>
