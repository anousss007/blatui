@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
])

{{--
    per-page-options renders a page-size select bound to a Livewire property, the same way
    searchable binds an input. Pass a plain list ([10, 25, 50]) and the values label themselves,
    or a map ([10 => '10 per page']) to write your own.

    Reset the paginator when it changes, or page 5 at 10-per-page lands past the end at 50:

        public function updatedPerPage() { $this->resetPage(); }
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    searchable
    search-model="search"
    per-page-model="perPage"
    :per-page-options="[10, 25, 50]"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
/>
