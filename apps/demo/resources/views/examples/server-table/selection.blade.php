@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
    ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
])

{{--
    Row selection: checkboxes bind to a Livewire array via wire:model (select-model="selected"),
    and the header checkbox toggles every row on the page. Pair it with bulk actions in your
    component. The select-all checkbox works client-side here so you can try it in this preview.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    selectable
    select-model="selected"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
/>
