<div>
    <h1 class="text-2xl font-bold">server-tree-table</h1>

    <div class="mt-6 flex gap-3">
        <x-ui.button wire:click="tick" data-testid="tick">Re-render</x-ui.button>
    </div>
    <p class="text-muted-foreground mt-2 text-sm">
        ticks: <span data-testid="ticks">{{ $ticks }}</span> ·
        reorders: <span data-testid="reorders">{{ $reorders }}</span> ·
        refused: <span data-testid="refused">{{ $refused ?? '' }}</span>
    </p>
    {{-- The server's own view of the tree: parent and position, as it would be stored. --}}
    <p class="text-sm">stored: <span data-testid="stored">{{ collect($categories)->sortBy(['parent_id', 'position'])->map(fn ($c) => $c['id'].'<'.($c['parent_id'] ?? '-').'>'.$c['position'])->implode(' ') }}</span></p>
    <p class="text-sm">expanded: <span data-testid="echo-expanded">{{ json_encode($expanded) }}</span></p>

    <div class="mt-6 max-w-xl" data-testid="tree">
        <x-ui.server-tree-table
            :rows="$this->rows()"
            parent-key="parent_id"
            :columns="[['key' => 'name', 'label' => 'Category']]"
            expanded-model="expanded"
            :expand-all="$search !== ''"
            searchable
            reorder-method="reorderCategories"
            reparent
            :actions="[['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'iconOnly' => true]]"
        />
    </div>
</div>
