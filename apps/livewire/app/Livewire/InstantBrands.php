<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * #59: the reporter's brands list, to measure what makes it feel slow and to prove the pattern
 * we recommend. A server-table of 66 brands with stat tiles above it, and row actions in one of
 * two shapes: `per-row` is theirs (a tooltip per button and a whole alert-dialog per row), and
 * `shared` is one dispatchable alert-dialog for the page. The create/edit dialog is a child
 * component, InstantBrandDialog, opened from here by browser events only.
 *
 * No database in this app: the brands live in the session, so a save is visible on the list.
 */
class InstantBrands extends Component
{
    use WithPagination;

    #[Url]
    public string $actions = 'per-row';

    /** Wrap the stat tiles in @island, so a sort or a search renders the table without them. */
    #[Url]
    public bool $island = false;

    public string $search = '';

    #[Url]
    public int $perPage = 10;

    public string $sort = 'name';

    public string $direction = 'asc';

    public static function brandList(): array
    {
        return session('instant-brands') ?? collect(range(1, 66))->mapWithKeys(fn ($i) => [$i => [
            'id' => $i,
            'name' => sprintf('Brand %02d', $i),
            'description' => "Description of brand {$i}",
            'active' => $i % 5 !== 0,
            'products_count' => $i % 3 === 0 ? $i : 0,
        ]])->all();
    }

    public static function put(array $brand): void
    {
        $all = static::brandList();
        $all[$brand['id']] = $brand;
        session(['instant-brands' => $all]);
    }

    public function updated(string $property): void
    {
        if (in_array($property, ['search', 'perPage'], true)) {
            $this->resetPage();
        }
    }

    public function sortBy(string $key): void
    {
        $this->direction = $this->sort === $key && $this->direction === 'asc' ? 'desc' : 'asc';
        $this->sort = $key;
        $this->resetPage();
    }

    public function delete(int $id): void {}

    /** Stands in for the reporter's brandStats: a few aggregate queries, ~150 ms of them. */
    #[Computed]
    public function brandStats(): array
    {
        usleep(150_000);
        $all = collect(static::brandList());

        return ['total' => $all->count(), 'active' => $all->where('active', true)->count(), 'products' => $all->where('products_count', '>', 0)->count()];
    }

    #[On('saved')]
    public function refreshStats(): void
    {
        if ($this->island) {
            $this->renderIsland('stats');
        }
    }

    #[Computed]
    public function brands()
    {
        $rows = collect(static::brandList())
            ->when($this->search !== '', fn ($c) => $c->filter(fn ($b) => str_contains(strtolower($b['name']), strtolower($this->search))))
            ->sortBy($this->sort, SORT_NATURAL, $this->direction === 'desc')
            ->values();

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $rows->forPage($this->getPage(), $this->perPage)->values(), $rows->count(), $this->perPage, $this->getPage(),
        );
    }

    public function render()
    {
        return view('livewire.instant.brands');
    }
}
