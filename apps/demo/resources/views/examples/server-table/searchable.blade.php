@php($users = [
    ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
    ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
    ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
])

{{--
    A search input bound to a Livewire property (search-model="search"). You run the actual
    filtering in your query: ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%")).
    The input is inert in this static preview.
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    searchable
    search-model="search"
    search-placeholder="Search members..."
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
/>
