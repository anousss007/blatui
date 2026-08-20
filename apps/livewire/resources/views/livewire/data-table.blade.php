<div>
    <h1 class="text-2xl font-bold">server-table toolbar across a re-render</h1>

    <p class="text-muted-foreground mt-2 text-sm">
        perPage: <span data-testid="per-page">{{ $perPage }}</span> ·
        visible: <span data-testid="visible">{{ implode(',', $visibleColumns) }}</span>
    </p>

    <x-ui.server-table
        class="mt-6"
        searchable
        search-model="search"
        per-page-model="perPage"
        :per-page-options="[10, 25, 50]"
        toggleable-columns
        :visible-columns="$visibleColumns"
        :columns="[
            ['key' => 'name', 'label' => 'Name', 'hideable' => false],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'role', 'label' => 'Role'],
            ['key' => 'status', 'label' => 'Status'],
        ]"
        :rows="$rows"
    >
        <x-slot:toolbar>
            <x-ui.button type="button" size="sm" variant="outline" data-testid="toolbar-slot">Custom filter</x-ui.button>
        </x-slot:toolbar>
    </x-ui.server-table>
</div>
