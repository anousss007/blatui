<?php

// API metadata for the checkbox component.

return [
    'props' => [
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the control, so a label can target it with its for attribute.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. When set, a hidden input carries the value so the checkbox submits with the form (only when checked).',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "'on'",
            'description' => 'Value submitted under "name" when the box is checked.',
        ],
        [
            'name' => 'checked',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the checkbox starts checked.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the control and dims it.',
        ],
        [
            'name' => 'indeterminate',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Starts in the mixed (dash) state, e.g. a parent of a partially-selected list. The first click resolves it to checked. Not supported with native.',
        ],
        [
            'name' => 'native',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render a real <input type="checkbox"> (styled via accent-color) for no-JS or native-submit forms, instead of the default Alpine-driven button.',
        ],
    ],
];
