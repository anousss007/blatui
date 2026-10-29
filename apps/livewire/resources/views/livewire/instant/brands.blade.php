<div>
    <h1 class="text-2xl font-bold">Brands (#59)</h1>

    @if ($island)
        @island(name: 'stats')
            @include('livewire.instant.stats')
        @endisland
    @else
        @include('livewire.instant.stats')
    @endif

    <div class="mt-4">
        {{-- A browser event, not wire:click: nothing on this component has to run to open it. --}}
        <x-ui.button x-on:click="$dispatch('brand-create')" data-testid="create">New brand</x-ui.button>
    </div>

    <x-ui.server-table
        class="mt-4"
        variant="card"
        row-key="id"
        :columns="[
            ['key' => 'name', 'label' => 'Name', 'sortable' => true],
            ['key' => 'description', 'label' => 'Description'],
            ['key' => 'active', 'label' => 'Status', 'sortable' => true],
        ]"
        :rows="$this->brands"
        :cell-views="['active' => 'livewire.instant.status-badge']"
        :sort="$sort"
        :direction="$direction"
        sort-method="sortBy"
        searchable
        search-model="search"
        :actions-view="'livewire.instant.actions-'.$actions"
    />

    @if ($actions !== 'per-row')
        {{-- One confirm for the whole page; the row it is about travels in the event detail. --}}
        <div x-data="{ brand: { id: null, name: '' } }" x-on:open-alert-dialog-delete-brand.window="brand = $event.detail">
            <x-ui.alert-dialog id="delete-brand">
                <x-ui.alert-dialog-content>
                    <x-ui.alert-dialog-header>
                        <x-ui.alert-dialog-title>Delete <span x-text="brand.name"></span>?</x-ui.alert-dialog-title>
                        <x-ui.alert-dialog-description>This cannot be undone.</x-ui.alert-dialog-description>
                    </x-ui.alert-dialog-header>
                    <x-ui.alert-dialog-footer>
                        <x-ui.alert-dialog-cancel>Cancel</x-ui.alert-dialog-cancel>
                        <x-ui.alert-dialog-action x-on:click="$wire.delete(brand.id)">Delete</x-ui.alert-dialog-action>
                    </x-ui.alert-dialog-footer>
                </x-ui.alert-dialog-content>
            </x-ui.alert-dialog>
        </div>
    @endif

    <livewire:instant-brand-dialog />
</div>
