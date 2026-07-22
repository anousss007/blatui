<?php

// API metadata for the switch component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. When set and the switch is on, a hidden input submits the value; when off, nothing is submitted.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "'on'",
            'description' => 'The value submitted under name when the switch is checked.',
        ],
        [
            'name' => 'checked',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the switch starts in the on (checked) state.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the switch so it cannot be toggled.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Track and thumb size of the switch.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'DOM id for the switch button, useful to pair with a label\'s for attribute.',
        ],
    ],
];
