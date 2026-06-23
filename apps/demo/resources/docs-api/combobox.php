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
            'name' => 'searchable',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the search input. Set false for a plain picker that lists every option with no filtering.',
        ],
        [
            'name' => 'multiple',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Allow picking many values. Selected items render as removable chips and the list stays open after each pick.',
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
