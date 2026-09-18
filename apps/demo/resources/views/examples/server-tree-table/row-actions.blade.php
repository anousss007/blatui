@php($categories = [
    ['id' => 1, 'name' => 'Clothing', 'products_count' => 42, 'children' => [
        ['id' => 2, 'name' => 'Men', 'products_count' => 18],
        ['id' => 3, 'name' => 'Women', 'products_count' => 24],
    ]],
    ['id' => 4, 'name' => 'Footwear', 'products_count' => 16],
])

{{-- The same actions as server-table: each one a native wire:click carrying the row's key. --}}
<x-ui.server-tree-table
    class="w-full max-w-2xl"
    variant="card"
    responsive="stack"
    :columns="[
        ['key' => 'name', 'label' => 'Category'],
        ['key' => 'products_count', 'label' => 'Products', 'align' => 'right'],
    ]"
    :rows="$categories"
    :expanded="[1]"
    actions-mode="dropdown"
    :actions="[
        ['label' => 'Add subcategory', 'icon' => 'plus', 'method' => 'createChild'],
        ['label' => 'Edit', 'icon' => 'pencil', 'method' => 'edit'],
        ['label' => 'Delete', 'icon' => 'trash-2', 'method' => 'delete', 'variant' => 'destructive', 'confirm' => 'Delete this category?'],
    ]"
/>
