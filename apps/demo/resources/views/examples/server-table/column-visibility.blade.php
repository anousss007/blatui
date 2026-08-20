@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'status' => 'Invited'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'status' => 'Active'],
])

{{--
    toggleable-columns adds a checkbox dropdown for showing and hiding columns. The filtering is
    server-side, like sorting: a hidden column is never rendered, so its cells are not built and
    never cross the wire. The host owns the state, exactly as it owns $sort:

        public array $visibleColumns = ['name', 'email', 'role', 'status'];

        public function toggleColumn(string $key): void
        {
            in_array($key, $this->visibleColumns, true)
                ? $this->visibleColumns = array_values(array_diff($this->visibleColumns, [$key]))
                : $this->visibleColumns[] = $key;
        }

    Mark a column ['hideable' => false] to keep it out of the menu and always on screen.
    Inert in this static preview.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    toggleable-columns
    :visible-columns="['name', 'email', 'status']"
    :columns="[
        ['key' => 'name', 'label' => 'Name', 'hideable' => false],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
        ['key' => 'status', 'label' => 'Status'],
    ]"
    :rows="$users"
/>
