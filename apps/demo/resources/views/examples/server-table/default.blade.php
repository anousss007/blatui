@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
    ['id' => 5, 'name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member'],
])

{{-- Server-rendered: pass an array, an Eloquent collection, or a paginator as :rows. --}}
<x-ui.server-table
    class="w-full max-w-2xl"
    caption="Team members"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role', 'align' => 'right'],
    ]"
    :rows="$users"
/>
