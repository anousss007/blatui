@php($categories = [
    ['id' => 1, 'name' => 'Clothing', 'children' => [
        ['id' => 2, 'name' => 'Men'],
        ['id' => 3, 'name' => 'Women'],
        ['id' => 4, 'name' => 'Kids'],
    ]],
    ['id' => 5, 'name' => 'Footwear', 'children' => [
        ['id' => 6, 'name' => 'Sneakers'],
        ['id' => 7, 'name' => 'Boots'],
    ]],
    ['id' => 8, 'name' => 'Accessories'],
])

{{-- Drag a row by its handle, or focus it and press Space, then the arrow keys. With
     `reparent`, Right/Left (or dropping onto the middle of a row) moves it under another
     parent. Under Livewire, reorder-method receives ($parentId, $ids, $movedId) once per
     drop; here the tree-reorder event shows the same payload. --}}
<div x-data="{ last: null }" x-on:tree-reorder="last = $event.detail" class="w-full max-w-xl space-y-3">
    <x-ui.server-tree-table
        caption="Categories"
        :columns="[['key' => 'name', 'label' => 'Category']]"
        :rows="$categories"
        :expanded="[1, 5]"
        reorderable
        reparent
    />
    <p class="text-muted-foreground text-sm">
        Last move: <code x-text="last ? JSON.stringify({ parent: last.parent, ids: last.ids, moved: last.moved }) : 'none yet'"></code>
    </p>
</div>
