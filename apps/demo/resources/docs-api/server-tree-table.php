<?php

// API metadata for the server-tree-table component.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The column definitions, in the same shape as server-table: key, label, sortable, align, class, width. The first column carries the indent and the expand button unless treeColumn says otherwise.',
        ],
        [
            'name' => 'rows',
            'type' => 'array|Collection|Paginator',
            'default' => '[]',
            'required' => true,
            'description' => 'The rows, rendered server-side. Either nested, with each row\'s children under childrenKey, or flat with parentKey. A paginator paginates the roots. Every row is rendered whether its branch is open or not, so expanding costs no request.',
        ],
        [
            'name' => 'rowKey',
            'type' => 'string',
            'default' => "'id'",
            'description' => 'The primary-key path read from each row (via data_get). Used for wire:key, for the open state, and as the ids sent to reorderMethod.',
        ],
        [
            'name' => 'childrenKey',
            'type' => 'string',
            'default' => "'children'",
            'description' => 'Where a nested row keeps its children: an array, a Collection, or an eager-loaded relation.',
        ],
        [
            'name' => 'parentKey',
            'type' => 'string',
            'description' => 'Pass flat rows, the shape one query returns, and name the column that points at the parent (e.g. parent_id). A row whose parent is not in the set is drawn as a root, so a search result or one page of a paginator still renders.',
        ],
        [
            'name' => 'treeColumn',
            'type' => 'string',
            'description' => 'The column key that carries the indent, the drag handle and the expand button. Defaults to the first column.',
        ],
        [
            'name' => 'expanded',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Keys of the rows that start open.',
        ],
        [
            'name' => 'expandAll',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show every row regardless of what is open. Server-driven, so :expand-all="$search !== \'\'" reveals matches inside closed branches while a search is active and gives the tree back when it is cleared.',
        ],
        [
            'name' => 'expandedModel',
            'type' => 'string',
            'description' => 'A Livewire array property to keep the open keys in. Opening a branch still makes no request; the keys ride along with the next one. Use it when the server should know, for example to persist the open branches or to keep them across a page change.',
        ],
        [
            'name' => 'reorderable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show drag handles and allow keyboard reordering. Rows move in the browser and a tree-reorder event reports each completed move.',
        ],
        [
            'name' => 'reorderMethod',
            'type' => 'string',
            'description' => 'The Livewire method called once per completed move with ($parentId, $ids, $movedId): the new parent (null for the root level), that parent\'s children in their new order, and the row that moved. Implies reorderable. Treat all three as untrusted input.',
        ],
        [
            'name' => 'reparent',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Allow a row to move under a different parent. By pointer, drop onto the middle of a row. By keyboard, press Right to nest under the row above or Left to move out a level. Without it, a row only moves among its siblings.',
        ],
        [
            'name' => 'sort',
            'type' => 'string',
            'description' => 'The current sort key, for aria-sort and the active header. Sorting happens in your query, per level. Reordering by hand only makes sense while sorted by position, so pass reorder-method only then.',
        ],
        [
            'name' => 'direction',
            'type' => 'string',
            'default' => "'asc'",
            'description' => 'The current sort direction, asc or desc.',
        ],
        [
            'name' => 'sortMethod',
            'type' => 'string',
            'default' => "'sortBy'",
            'description' => 'The Livewire method a sortable header calls with the column key.',
        ],
        [
            'name' => 'actions',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Declarative row actions, in the same shape as server-table\'s: each renders a native wire:click carrying the row\'s real key.',
        ],
        [
            'name' => 'actionsView',
            'type' => 'string',
            'description' => 'A Blade view included per row, with $row and $depth in scope, for fully custom action markup.',
        ],
        [
            'name' => 'actionsMode',
            'type' => 'string',
            'default' => "'inline'",
            'options' => ['inline', 'dropdown'],
            'description' => 'Buttons in the row, or an overflow menu.',
        ],
        [
            'name' => 'cellViews',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Map of column key to a Blade view, included with $value, $row and $depth in scope.',
        ],
        [
            'name' => 'searchable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render a search input bound to searchModel with wire:model.live.debounce.300ms.',
        ],
        [
            'name' => 'searchModel',
            'type' => 'string',
            'default' => "'search'",
            'description' => 'The Livewire property the search input binds to.',
        ],
        [
            'name' => 'perPageOptions',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Page sizes for a select bound to perPageModel. Empty renders no select.',
        ],
        [
            'name' => 'responsive',
            'type' => 'string',
            'default' => "'scroll'",
            'options' => ['scroll', 'stack'],
            'description' => 'scroll keeps a table that scrolls sideways on narrow screens. stack turns each row into a card below md, indented by its depth.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'card'],
            'description' => 'A plain bordered table, or one on a card surface.',
        ],
        [
            'name' => 'caption',
            'type' => 'string',
            'description' => 'Accessible table caption (screen-reader only unless captionVisible).',
        ],
        [
            'name' => 'emptyText',
            'type' => 'string',
            'default' => "__('No results.')",
            'description' => 'Shown when there are no rows.',
        ],
    ],

    'events' => [
        [
            'name' => 'tree-reorder',
            'direction' => 'out',
            'detail' => '{ parent, ids, moved, from }',
            'description' => 'A move was completed, by pointer or keyboard. The detail carries the new parent, its children in their new order, the moved key and the parent it came from. Integer keys arrive as numbers. Dispatched with or without reorderMethod, so it works without Livewire too.',
        ],
    ],

    'slots' => [
        [
            'name' => 'toolbar',
            'description' => 'An open slot on the toolbar row, after the search input, for filters and bulk actions bound to your own Livewire properties.',
        ],
    ],
];
