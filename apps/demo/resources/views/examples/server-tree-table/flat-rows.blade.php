@php($rows = [
    ['id' => 10, 'parent_id' => null, 'name' => 'Engineering', 'members' => 24],
    ['id' => 11, 'parent_id' => 10, 'name' => 'Platform', 'members' => 9],
    ['id' => 12, 'parent_id' => 11, 'name' => 'Infrastructure', 'members' => 4],
    ['id' => 13, 'parent_id' => 10, 'name' => 'Product', 'members' => 15],
    ['id' => 14, 'parent_id' => null, 'name' => 'Design', 'members' => 6],
    ['id' => 15, 'parent_id' => 14, 'name' => 'Research', 'members' => 2],
])

{{-- Flat rows, the shape one query returns: parent-key builds the tree. A row whose parent
     is not in the set becomes a root, so a filtered or paginated result still renders. --}}
<x-ui.server-tree-table
    class="w-full max-w-xl"
    caption="Teams"
    parent-key="parent_id"
    :columns="[
        ['key' => 'name', 'label' => 'Team'],
        ['key' => 'members', 'label' => 'Members', 'align' => 'right'],
    ]"
    :rows="$rows"
    expand-all
/>
