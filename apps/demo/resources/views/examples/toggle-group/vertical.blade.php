{{-- Vertical orientation: items stack and join top-to-bottom. --}}
<x-ui.toggle-group type="single" variant="outline" orientation="vertical" value="list" class="w-40">
    <x-ui.toggle-group-item value="grid" aria-label="Grid view">
        <x-lucide-layout-grid /> Grid
    </x-ui.toggle-group-item>
    <x-ui.toggle-group-item value="list" aria-label="List view">
        <x-lucide-list /> List
    </x-ui.toggle-group-item>
    <x-ui.toggle-group-item value="columns" aria-label="Columns view">
        <x-lucide-columns-3 /> Columns
    </x-ui.toggle-group-item>
</x-ui.toggle-group>
