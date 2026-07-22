@php
    $all = collect([
        ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner'],
        ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member'],
        ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member'],
        ['id' => 4, 'name' => 'William Kim', 'email' => 'will@example.com', 'role' => 'Admin'],
        ['id' => 5, 'name' => 'Sofia Davis', 'email' => 'sofia@example.com', 'role' => 'Member'],
        ['id' => 6, 'name' => 'Liam Johnson', 'email' => 'liam@example.com', 'role' => 'Member'],
        ['id' => 7, 'name' => 'Emma Brown', 'email' => 'emma@example.com', 'role' => 'Admin'],
        ['id' => 8, 'name' => 'Noah Wilson', 'email' => 'noah@example.com', 'role' => 'Member'],
    ]);

    $perPage = 5;
    $page = 1;

    // In a real app this is simply User::paginate(5) inside a Livewire component (WithPagination).
    $users = new \Illuminate\Pagination\LengthAwarePaginator(
        $all->forPage($page, $perPage)->values(),
        $all->count(),
        $perPage,
        $page,
        ['path' => '#'],
    );
@endphp

{{-- Pass a paginator as :rows and server-table renders its page links below the table. --}}
<x-ui.server-table
    class="w-full max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ]"
    :rows="$users"
/>
