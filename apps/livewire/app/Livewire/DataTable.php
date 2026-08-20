<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * The server-table toolbar under a real Livewire runtime (#21).
 *
 * The docs previews are static — apps/demo has no Livewire — so a page-size select and a column
 * dropdown render there but never round-trip. Both of these are `wire:` bindings whose whole
 * behaviour is the round trip, and the column dropdown in particular seeds Alpine `checked` state
 * from the server, which is exactly the shape that a morph leaves stale. That needs a real morph
 * to test, which is what this app is for.
 */
class DataTable extends Component
{
    public string $search = '';

    public int $perPage = 10;

    /** @var array<int, string> */
    public array $visibleColumns = ['name', 'email', 'role', 'status'];

    public function toggleColumn(string $key): void
    {
        $this->visibleColumns = in_array($key, $this->visibleColumns, true)
            ? array_values(array_diff($this->visibleColumns, [$key]))
            : [...$this->visibleColumns, $key];
    }

    public function render()
    {
        $rows = collect([
            ['id' => 1, 'name' => 'Olivia Martin', 'email' => 'olivia@example.com', 'role' => 'Owner', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Jackson Lee', 'email' => 'jackson@example.com', 'role' => 'Member', 'status' => 'Invited'],
            ['id' => 3, 'name' => 'Isabella Nguyen', 'email' => 'isabella@example.com', 'role' => 'Member', 'status' => 'Active'],
        ])->when($this->search !== '', fn ($c) => $c->filter(
            fn ($r) => str_contains(strtolower($r['name']), strtolower($this->search)),
        ))->take($this->perPage)->values();

        return view('livewire.data-table', ['rows' => $rows]);
    }
}
