<?php

// API metadata for the time-field component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. When set, a hidden input submits the value as "HH:mm" (or "HH:mm:ss").',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'Initial time, as "HH:mm" or "HH:mm:ss".',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'input'",
            'options' => ['input', 'select'],
            'description' => 'input renders a native time input (segmented editing, keyboard, mobile wheel); select renders native hour/minute dropdowns.',
        ],
        [
            'name' => 'hourCycle',
            'type' => 'string',
            'default' => "'auto'",
            'options' => ['auto', '12', '24'],
            'description' => 'Clock format for the select variant and display. auto follows the visitor\'s locale; 12 adds an AM/PM dropdown.',
        ],
        [
            'name' => 'seconds',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Include a seconds component in the control and the emitted value.',
        ],
        [
            'name' => 'minuteStep',
            'type' => 'int',
            'default' => '1',
            'description' => 'Minute increment (e.g. 15 for quarter-hour stepping). Applies to both variants.',
        ],
        [
            'name' => 'secondStep',
            'type' => 'int',
            'default' => '1',
            'description' => 'Second increment, used only when seconds is enabled.',
        ],
        [
            'name' => 'min',
            'type' => 'string',
            'description' => 'Earliest selectable time ("HH:mm"). Input variant only.',
        ],
        [
            'name' => 'max',
            'type' => 'string',
            'description' => 'Latest selectable time ("HH:mm"). Input variant only.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the control so it cannot be edited.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'id applied to the underlying control, e.g. to pair with a label.',
        ],
        [
            'name' => 'part',
            'type' => 'string',
            'description' => 'Composition tag echoed back in the time-change event\'s detail.part (e.g. "from"/"to"). Used by datetime-picker to tell which field changed.',
        ],
    ],

    'methods' => [
        [
            'name' => 'fromInput(value)',
            'description' => 'Input variant: sets the value from the native control and dispatches the time-change event.',
        ],
        [
            'name' => 'sync()',
            'description' => 'Recomputes the "HH:mm" value from the hour/minute/second parts and dispatches the time-change event.',
        ],
    ],
];
