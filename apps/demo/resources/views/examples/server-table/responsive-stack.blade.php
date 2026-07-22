@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
])

{{--
    responsive="stack" turns each row into a labelled card below the md breakpoint (resize the
    preview to see it), while staying a normal table on larger screens. Each cell keeps a visible,
    screen-reader-friendly label on mobile — no reliance on CSS pseudo-content.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    responsive="stack"
    variant="card"
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
