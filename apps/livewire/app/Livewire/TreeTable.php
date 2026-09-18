<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * server-tree-table under a real Livewire runtime. Issue #32.
 *
 * The categories are the report's shape — flat rows with parent_id and position, one query's
 * worth — kept in the component instead of a database. reorderCategories() is the server half
 * the docs recommend: it trusts nothing it is sent, and "Locked" refuses to take children, so
 * the suite can prove that a refused move is put back by the next render rather than by a
 * rollback path in the browser.
 */
class TreeTable extends Component
{
    public array $categories = [
        ['id' => 1, 'parent_id' => null, 'position' => 0, 'name' => 'Clothing'],
        ['id' => 2, 'parent_id' => 1, 'position' => 0, 'name' => 'Men'],
        ['id' => 3, 'parent_id' => 1, 'position' => 1, 'name' => 'Women'],
        ['id' => 4, 'parent_id' => 1, 'position' => 2, 'name' => 'Kids'],
        ['id' => 5, 'parent_id' => null, 'position' => 1, 'name' => 'Footwear'],
        ['id' => 6, 'parent_id' => 5, 'position' => 0, 'name' => 'Sneakers'],
        ['id' => 7, 'parent_id' => 5, 'position' => 1, 'name' => 'Boots'],
        ['id' => 8, 'parent_id' => null, 'position' => 2, 'name' => 'Locked'],
    ];

    public array $expanded = [];

    public string $search = '';

    public int $ticks = 0;

    public int $reorders = 0;

    public ?string $refused = null;

    public function tick(): void
    {
        $this->ticks++;
    }

    public function reorderCategories(?int $parentId, array $ids, int $movedId): void
    {
        $this->reorders++;
        $this->refused = null;
        $byId = collect($this->categories)->keyBy('id');
        $ids = array_map('intval', $ids);

        // Every id, and the parent, must exist; the parent may not be the moved row or under it.
        if (collect($ids)->contains(fn ($id) => ! $byId->has($id)) || ($parentId !== null && ! $byId->has($parentId))) {
            $this->refused = 'unknown id';

            return;
        }
        for ($p = $parentId; $p !== null; $p = $byId[$p]['parent_id']) {
            if ($p === $movedId) {
                $this->refused = 'cycle';

                return;
            }
        }
        if ($parentId === 8) {
            $this->refused = 'locked';

            return;
        }

        foreach ($this->categories as &$c) {
            if (($i = array_search($c['id'], $ids, true)) !== false) {
                $c['parent_id'] = $parentId;
                $c['position'] = $i;
            }
        }
    }

    public function delete(int $id): void
    {
        $this->categories = array_values(array_filter($this->categories, fn ($c) => $c['id'] !== $id && $c['parent_id'] !== $id));
    }

    public function rows(): array
    {
        return collect($this->categories)
            ->when($this->search !== '', fn ($c) => $c->filter(fn ($r) => str_contains(strtolower($r['name']), strtolower($this->search))))
            ->sortBy('position')
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.tree-table');
    }
}
