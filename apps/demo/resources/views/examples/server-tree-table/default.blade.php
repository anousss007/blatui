@php($categories = [
    ['id' => 1, 'name' => 'Clothing', 'products_count' => 42, 'status' => 'Active', 'children' => [
        ['id' => 2, 'name' => 'Men', 'products_count' => 18, 'status' => 'Active', 'children' => [
            ['id' => 3, 'name' => 'Shirts', 'products_count' => 11, 'status' => 'Active'],
            ['id' => 4, 'name' => 'Trousers', 'products_count' => 7, 'status' => 'Draft'],
        ]],
        ['id' => 5, 'name' => 'Women', 'products_count' => 24, 'status' => 'Active'],
    ]],
    ['id' => 6, 'name' => 'Footwear', 'products_count' => 16, 'status' => 'Active', 'children' => [
        ['id' => 7, 'name' => 'Sneakers', 'products_count' => 9, 'status' => 'Active'],
        ['id' => 8, 'name' => 'Boots', 'products_count' => 7, 'status' => 'Archived'],
    ]],
    ['id' => 9, 'name' => 'Accessories', 'products_count' => 5, 'status' => 'Draft'],
])

{{-- Nested rows: each row's children under `children` — an array, a Collection, or a loaded relation. --}}
<x-ui.server-tree-table
    class="w-full max-w-2xl"
    caption="Categories"
    :columns="[
        ['key' => 'name', 'label' => 'Category'],
        ['key' => 'products_count', 'label' => 'Products', 'align' => 'right'],
        ['key' => 'status', 'label' => 'Status'],
    ]"
    :rows="$categories"
    :expanded="[1]"
/>
