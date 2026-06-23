<?php

// API metadata for the select component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'options',
            'type' => '[value => label]',
            'description' => 'Shorthand that auto-composes the trigger, content and items (or native <option>s). Associative keys are values; a plain list uses the value as its own label. Omit it to build the listbox with the compositional slot API instead.',
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
            'default' => "''",
            'description' => 'Trigger text shown when nothing is selected. Pass a translated string; empty by default so no English leaks.',
        ],
        [
            'name' => 'multiple',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Allow picking many values. Selected items render as removable chips in the trigger and the list stays open after each pick.',
        ],
        [
            'name' => 'native',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render a styled native <select> (submits without JS) instead of the rich JS listbox. Put <option>s in the slot when not using options.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Trigger height. Applies to the native variant.',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'A CSS color that brands the trigger\'s focus ring and selected accent for this instance only.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The compositional listbox when options is omitted: <x-ui.select-trigger> (with <x-ui.select-value>) followed by <x-ui.select-content> wrapping <x-ui.select-item> entries (optionally grouped with select-group/select-label/select-separator). For the native variant, place plain <option> elements here.',
        ],
    ],

    'methods' => [
        [
            'name' => 'openList()',
            'description' => 'Opens the listbox and moves focus to the selected (or first) option.',
        ],
        [
            'name' => 'toggleList()',
            'description' => 'Opens the listbox if closed, otherwise closes it.',
        ],
        [
            'name' => 'close()',
            'description' => 'Closes the listbox and returns focus to the trigger.',
        ],
        [
            'name' => 'selectOption(value, label)',
            'description' => 'Selects the given value (toggles it when multiple). Single select also closes the list.',
        ],
    ],
];
