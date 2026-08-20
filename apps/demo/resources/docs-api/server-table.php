<?php

// API metadata for the server-table component.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The column definitions. The order here sets the column order, and each column reads its value from the matching key in every row (via data_get, so nested keys like "author.name" and Eloquent accessors both work).',
            'shape' => 'column',
        ],
        [
            'name' => 'rows',
            'type' => 'array|Collection|Paginator',
            'default' => '[]',
            'required' => true,
            'description' => 'The data rows. Accepts an array, an Eloquent collection, or a LengthAwarePaginator. Rows are rendered server-side with a real @foreach, so row-action buttons receive the genuine model and primary key. Sorting, searching and pagination are driven by your Livewire component, not client-side.',
        ],
        [
            'name' => 'rowKey',
            'type' => 'string',
            'default' => "'id'",
            'description' => 'The primary-key path read from each row (via data_get). Used for wire:key row identity and as the default argument passed to row-action methods.',
        ],
        [
            'name' => 'sort',
            'type' => 'string',
            'description' => 'The currently sorted column key. Drives the active header state and the aria-sort attribute. Bind it to a Livewire property.',
        ],
        [
            'name' => 'direction',
            'type' => 'string',
            'default' => "'asc'",
            'options' => ['asc', 'desc'],
            'description' => 'The current sort direction, reflected in the header chevron and aria-sort.',
        ],
        [
            'name' => 'sortMethod',
            'type' => 'string',
            'default' => "'sortBy'",
            'description' => 'The Livewire method invoked when a sortable header is clicked, as wire:click="sortBy(\'key\')". Implement it to flip direction and set the sort property.',
        ],
        [
            'name' => 'actions',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Declarative per-row actions. Each renders a button (or menu item, in dropdown mode) with a native wire:click carrying the real primary key.',
            'shape' => 'action',
        ],
        [
            'name' => 'actionsView',
            'type' => 'string',
            'description' => 'Escape hatch for fully custom actions: a Blade view name included once per row with $row (the real model) in scope. Use raw wire:click="edit($row->id)" markup inside. Overrides the declarative actions array.',
        ],
        [
            'name' => 'actionsMode',
            'type' => 'string',
            'default' => "'inline'",
            'options' => ['inline', 'dropdown'],
            'description' => 'Render declarative actions as inline buttons, or collapsed into an overflow "…" dropdown menu (better on narrow screens or with many actions).',
        ],
        [
            'name' => 'actionsLabel',
            'type' => 'string',
            'default' => "'Actions'",
            'description' => 'Accessible label for the actions column header (rendered sr-only) and the dropdown trigger.',
        ],
        [
            'name' => 'stickyActions',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Freeze the actions column to the right edge so it stays visible while the table scrolls horizontally.',
        ],
        [
            'name' => 'cellViews',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Map of column key => Blade view name for custom cell rendering. Each view is included with $value (the cell value) and $row (the model) in scope, e.g. ["status" => "partials.status-badge"].',
        ],
        [
            'name' => 'selectable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show a checkbox column bound with wire:model to a Livewire array property, plus a select-all checkbox for the current page.',
        ],
        [
            'name' => 'selectModel',
            'type' => 'string',
            'default' => "'selected'",
            'description' => 'The Livewire array property the row checkboxes bind to via wire:model.live.',
        ],
        [
            'name' => 'searchable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show a search input above the table, bound to a Livewire property. You perform the actual filtering in your query.',
        ],
        [
            'name' => 'searchModel',
            'type' => 'string',
            'default' => "'search'",
            'description' => 'The Livewire property the search input binds to via wire:model.live.debounce.300ms.',
        ],
        [
            'name' => 'searchPlaceholder',
            'type' => 'string',
            'default' => "'Search...'",
            'description' => 'Placeholder (and accessible label) for the search input.',
        ],
        [
            'name' => 'perPageOptions',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Page sizes offered in a select in the toolbar. A plain list ([10, 25, 50]) labels each option with its own value; a map ([10 => \'10 per page\']) uses your labels. Empty renders no select. Reset the paginator when it changes (updatedPerPage() => $this->resetPage()), or page 5 at 10-per-page lands past the end of the same result set at 50.',
        ],
        [
            'name' => 'perPageModel',
            'type' => 'string',
            'default' => "'perPage'",
            'description' => 'The Livewire property the page-size select binds to via wire:model.live.',
        ],
        [
            'name' => 'perPageLabel',
            'type' => 'string',
            'default' => "'Rows per page'",
            'description' => 'Accessible label for the page-size select.',
        ],
        [
            'name' => 'toggleableColumns',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show a checkbox dropdown in the toolbar for hiding and showing columns. Filtering is server-side like sorting: a hidden column is not rendered at all, so its cells are never built and never cross the wire.',
        ],
        [
            'name' => 'visibleColumns',
            'type' => 'array|null',
            'description' => 'The column keys currently visible. null means the table is not being controlled and every column shows; an empty array means every hideable column is hidden, which is a state the host can reach by unchecking everything. Columns marked hideable => false always render regardless.',
        ],
        [
            'name' => 'toggleColumnMethod',
            'type' => 'string',
            'default' => "'toggleColumn'",
            'description' => 'The Livewire method each checkbox calls with the column key, e.g. wire:click="toggleColumn(\'email\')". You own the state, exactly as you own $sort — the component reports the toggle and re-renders from what you hand back.',
        ],
        [
            'name' => 'caption',
            'type' => 'string',
            'description' => 'An accessible <caption> describing the table. Rendered sr-only unless captionVisible is true.',
        ],
        [
            'name' => 'captionVisible',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show the caption visibly above the table instead of only to screen readers.',
        ],
        [
            'name' => 'emptyText',
            'type' => 'string',
            'default' => "'No results.'",
            'description' => 'Message shown when rows is empty.',
        ],
        [
            'name' => 'emptyIcon',
            'type' => 'string',
            'default' => "'search-x'",
            'description' => 'Lucide icon name shown in the empty state.',
        ],
        [
            'name' => 'responsive',
            'type' => 'string',
            'default' => "'scroll'",
            'options' => ['scroll', 'stack'],
            'description' => 'How the table adapts on small screens. "scroll" keeps the table layout and scrolls horizontally; "stack" turns each row into a labelled card below the md breakpoint.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'card'],
            'description' => 'Visual container style — a plain bordered table, or an elevated card surface.',
        ],
        [
            'name' => 'paginate',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'When rows is a paginator, render its links() below the table (Livewire-aware when the WithPagination trait is used).',
        ],
    ],

    'shapes' => [
        'column' => [
            'label' => 'Each column',
            'fields' => [
                [
                    'name' => 'key',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The row-data path this column reads (data_get: supports "name", nested "author.name", and model accessors).',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'Header text. Defaults to the humanized key.',
                ],
                [
                    'name' => 'sortable',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Render the header as a sort button (wire:click to sortMethod). You perform the ordering server-side.',
                ],
                [
                    'name' => 'hideable',
                    'type' => 'bool',
                    'default' => 'true',
                    'description' => 'Whether toggleableColumns may hide this column. false keeps it out of the menu and always on screen — for the name or identifier column a row is unreadable without.',
                ],
                [
                    'name' => 'align',
                    'type' => 'string',
                    'default' => "'left'",
                    'options' => ['left', 'center', 'right'],
                    'description' => 'Text alignment for the header and cells.',
                ],
                [
                    'name' => 'width',
                    'type' => 'string',
                    'description' => 'Optional fixed column width, e.g. "12rem" or "20%".',
                ],
                [
                    'name' => 'class',
                    'type' => 'string',
                    'description' => 'Extra CSS classes applied to this column\'s header and cells.',
                ],
            ],
        ],
        'action' => [
            'label' => 'Each action',
            'fields' => [
                [
                    'name' => 'label',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Button / menu-item text. Also used as the accessible label when iconOnly is set.',
                ],
                [
                    'name' => 'method',
                    'type' => 'string',
                    'description' => 'The Livewire method to call, rendered as wire:click="method(rowKey)". Omit when using href.',
                ],
                [
                    'name' => 'href',
                    'type' => 'string|Closure',
                    'description' => 'Render a link instead of a wire:click. A string may contain {id} (replaced with the row key), or pass a closure fn ($row) => route(...).',
                ],
                [
                    'name' => 'params',
                    'type' => 'array',
                    'description' => 'Override the method arguments. Defaults to [rowKey value]. Integers are passed bare, strings are quoted.',
                ],
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'description' => 'Optional Lucide icon name shown before the label.',
                ],
                [
                    'name' => 'iconOnly',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Hide the label visually (kept as an aria-label). Inline mode only.',
                ],
                [
                    'name' => 'variant',
                    'type' => 'string',
                    'default' => "'ghost'",
                    'description' => 'Button variant (default, ghost, outline, secondary, destructive, link). Use "destructive" for delete-style actions.',
                ],
                [
                    'name' => 'color',
                    'type' => 'string',
                    'description' => 'Any CSS colour to recolor the button locally (best with solid variants), e.g. "var(--destructive)".',
                ],
                [
                    'name' => 'class',
                    'type' => 'string',
                    'description' => 'Extra CSS classes merged onto the button — e.g. "text-destructive hover:text-destructive" for a red ghost delete. Inline mode only.',
                ],
                [
                    'name' => 'size',
                    'type' => 'string',
                    'default' => "'sm'",
                    'description' => 'Button size (xs, sm, default, lg). Inline mode only.',
                ],
                [
                    'name' => 'confirm',
                    'type' => 'string',
                    'description' => 'A confirmation message. Rendered as wire:confirm, so Livewire prompts before running the action.',
                ],
                [
                    'name' => 'visible',
                    'type' => 'Closure',
                    'description' => 'Optional predicate fn ($row) => bool. Return false to hide this action for a given row (e.g. permissions).',
                ],
            ],
        ],
    ],

    'slots' => [
        [
            'name' => 'toolbar',
            'description' => 'An open slot on the toolbar row, beside the search input and before the page-size and column controls. For the filters no prop will ever cover — a status select, a date range, a bulk-action button — bound to your own Livewire properties. Present the toolbar row even with searchable off.',
        ],
        [
            'name' => 'actions (via actionsView)',
            'description' => 'For custom action markup, pass actionsView="your.view"; it is included per row with the real $row model in scope, so wire:click="edit($row->id)" works natively. This is the server-rendered counterpart to the data-table actions slot.',
        ],
    ],
];
