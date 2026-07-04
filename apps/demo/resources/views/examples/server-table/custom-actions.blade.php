@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
])

{{--
    Full control over the action markup: point `actions-view` at a Blade partial. It is included
    per row with the real $row model in scope, so you write ordinary wire:click="edit($row->id)"
    — the server-rendered answer to the data-table actions slot. See the partial for the markup.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    actions-view="examples.server-table.partials.user-actions"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
/>
