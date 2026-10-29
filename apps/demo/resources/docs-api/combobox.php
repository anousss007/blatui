<?php

// API metadata for the combobox component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'options',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The selectable options. Each entry may be a plain string (used as both value and label) or an associative array with value and label.',
            'shape' => 'option',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'default' => "''",
            'description' => 'The initially selected value. Pass an array of values when multiple is true.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. A hidden input mirrors the selection so it submits with a form (as name[] when multiple).',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Trigger text shown when nothing is selected. Defaults to a translatable "Select option..." string.',
        ],
        [
            'name' => 'searchPlaceholder',
            'type' => 'string',
            'description' => 'Placeholder for the search input. Defaults to a translatable "Search..." string.',
        ],
        [
            'name' => 'empty',
            'type' => 'string',
            'description' => 'Message shown when the search matches no options. Defaults to a translatable "No results found." string.',
        ],
        [
            'name' => 'trigger',
            'type' => 'string',
            'default' => "'button'",
            'options' => ['button', 'input'],
            'description' => 'How the listbox is opened. "button" is the classic popover with a search input inside. "input" makes the field itself the search box — the inline autocomplete shape (replaces the deprecated <x-ui.autocomplete>).',
        ],
        [
            'name' => 'searchable',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the search input (button trigger only). Set false for a plain picker that lists every option with no filtering.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Height and text size of the field (input trigger, single-select).',
        ],
        [
            'name' => 'icon',
            'type' => 'string',
            'description' => 'Optional leading Lucide icon name, e.g. "search" (input trigger only).',
        ],
        [
            'name' => 'multiple',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Allow picking many values. Selected items render as removable chips and the list stays open after each pick.',
        ],
        [
            'name' => 'indicator',
            'type' => 'string',
            'default' => "'check'",
            'options' => ['check', 'checkbox', 'radio'],
            'description' => 'How a selected option is marked in the list: a trailing check, a checkbox box (pairs well with multiple), or a radio dot (pairs well with single-select).',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the trigger so the list cannot be opened.',
        ],
        [
            'name' => 'width',
            'type' => 'string',
            'default' => "'w-[200px]'",
            'description' => 'Tailwind width class for the trigger; the popover matches the trigger\'s width.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Set on the focusable control: the trigger button, or the text field with trigger="input". A <label for="{id}"> then names it and focuses it on click, as with a native select. The search field inside the popover gets {id}-search.',
        ],
        [
            'name' => 'remote',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Since 1.39. The options come from the server, a page at a time, through the combobox-fetch event: while the user types (debounced), when the list opens on a query it has not fetched yet, and when the list is scrolled near its end. The browser stops filtering, since the server already did. Enter pressed before the answer arrives waits for it, and picks the only match if there is exactly one (a barcode scanner).',
        ],
        [
            'name' => 'pageSize',
            'type' => 'int',
            'default' => '30',
            'description' => 'Since 1.39. With remote: how many options to ask for per page, sent as detail.limit.',
        ],
        [
            'name' => 'debounce',
            'type' => 'int',
            'default' => '250',
            'description' => 'Since 1.39. With remote: milliseconds of quiet typing before a search is sent.',
        ],
    ],

    'slots' => [
        [
            'name' => 'start',
            'description' => 'Since 1.39. Input trigger, single select: content inside the field before the text, like an input-group addon (a search icon). Replaces the icon prop.',
        ],
        [
            'name' => 'end',
            'description' => 'Since 1.39. Input trigger, single select: content inside the field after the text, in place of the chevron. Icon-only <x-ui.input-group-button>s fit here; clicking them does not open the list.',
        ],
    ],

    'events' => [
        [
            'name' => 'combobox-fetch',
            'direction' => 'out',
            'detail' => '{ query, offset, limit, respond }',
            'description' => 'Since 1.39, with remote. Asks for options. offset 0 is a new search and replaces the list; a higher offset is the next page and is appended. Call respond() with an array of options, with { options, hasMore }, or with a promise of either: x-on:combobox-fetch="$event.detail.respond($wire.searchCustomers($event.detail.query, $event.detail.offset, $event.detail.limit))". Mark that method #[Renderless]: it only returns data. An answer overtaken by a newer search is dropped.',
        ],
        [
            'name' => 'combobox-select',
            'direction' => 'out',
            'detail' => '{ value, option }',
            'description' => 'Since 1.39. A pick, with the whole option: any key beyond value and label (a document number, a price) comes along. It is cancelable: call $event.preventDefault() to take the pick over, and nothing is stored, the list closes and the field empties for the next pick (add a line to a table, scan the next code).',
        ],
    ],

    'shapes' => [
        'option' => [
            'label' => 'Each option',
            'fields' => [
                [
                    'name' => 'value',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The submitted value for this option.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'Visible, searchable text for the option. Falls back to value when omitted.',
                ],
                [
                    'name' => '…',
                    'type' => 'mixed',
                    'description' => 'Any other key is kept on the option and travels with combobox-select.',
                ],
            ],
        ],
    ],

    'methods' => [
        [
            'name' => 'openList()',
            'description' => 'Opens the popover, clears the query and focuses the search input.',
        ],
        [
            'name' => 'close()',
            'description' => 'Closes the popover and returns focus to the trigger.',
        ],
        [
            'name' => 'select(value)',
            'description' => 'Selects the given value (toggles it when multiple). Single select also closes the list.',
        ],
        [
            'name' => 'remove(value)',
            'description' => 'Removes a value from the multiple selection.',
        ],
    ],
];
