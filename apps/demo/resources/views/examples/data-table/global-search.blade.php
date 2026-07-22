@php($rows = [
    ['name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
    ['name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member'],
])

{{--
    Omit search-key and the filter matches across every column — try typing "admin" or a name.
    Filtering runs entirely client-side in Alpine.
--}}
<x-ui.data-table
    class="w-full max-w-2xl"
    :selectable="false"
    search-placeholder="Search name, email or role..."
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$rows"
/>
