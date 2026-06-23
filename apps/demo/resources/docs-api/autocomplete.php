<?php

// API metadata for the autocomplete component. Rendered by resources/views/components/docs/api.blade.php.

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
            'default' => "'Search...'",
            'description' => 'Placeholder for the text input.',
        ],
        [
            'name' => 'empty',
            'type' => 'string',
            'default' => "'No results found.'",
            'description' => 'Message shown when the typed query matches no options.',
        ],
        [
            'name' => 'multiple',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Tag-input mode: selected values render as removable chips inside the field and the list stays open after each pick.',
        ],
        [
            'name' => 'icon',
            'type' => 'string',
            'description' => 'Optional leading Lucide icon name (e.g. "search").',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Height and text size of the input (single-select only).',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the input so the list cannot be opened.',
        ],
        [
            'name' => 'width',
            'type' => 'string',
            'default' => "'w-[260px]'",
            'description' => 'Tailwind width class for the field and the popover.',
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
                    'description' => 'Visible, type-to-filter text for the option. Falls back to value when omitted.',
                ],
            ],
        ],
    ],

    'methods' => [
        [
            'name' => 'openList()',
            'description' => 'Opens the popover showing all options (no filtering yet).',
        ],
        [
            'name' => 'close()',
            'description' => 'Closes the popover and stops filtering.',
        ],
        [
            'name' => 'select(value)',
            'description' => 'Selects the given value (toggles it when multiple). Single select fills the input with its label and closes the list.',
        ],
        [
            'name' => 'remove(value)',
            'description' => 'Removes a value from the multiple selection.',
        ],
    ],
];
