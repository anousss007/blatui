<?php

// API metadata for the datetime-picker component.

return [
    'props' => [
        [
            'name' => 'mode',
            'type' => 'string',
            'default' => "'single'",
            'options' => ['single', 'range'],
            'description' => 'Pick one date and time, or a from–to range. Range submits two values and shows two months by default.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name for the hidden input. In range mode it submits as name[from] and name[to]; otherwise a single name.',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'description' => 'Initial selection. Single mode: a "Y-m-d\TH:i" (or "Y-m-d H:i") string. Range mode: an array shaped [\'from\' => ..., \'to\' => ...].',
            'shape' => 'rangeValue',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Trigger text shown when nothing is selected. Defaults to "Pick a date & time" (single) or "Pick a date range" (range).',
        ],
        [
            'name' => 'hourCycle',
            'type' => 'string',
            'default' => "'auto'",
            'options' => ['auto', '12', '24'],
            'description' => 'Clock format for the time control and the label. auto follows the visitor\'s locale.',
        ],
        [
            'name' => 'timeVariant',
            'type' => 'string',
            'default' => "'input'",
            'options' => ['input', 'select'],
            'description' => 'Time control style forwarded to the time-field: a native time input or hour/minute dropdowns.',
        ],
        [
            'name' => 'seconds',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Include a seconds component in the time control and the displayed value.',
        ],
        [
            'name' => 'minuteStep',
            'type' => 'int',
            'default' => '1',
            'description' => 'Minute increment for the time control (e.g. 15 for quarter-hour stepping).',
        ],
        [
            'name' => 'captionLayout',
            'type' => 'string',
            'default' => "'dropdown'",
            'options' => ['label', 'dropdown'],
            'description' => 'Calendar header style: a static month/year label, or month/year dropdowns for fast navigation.',
        ],
        [
            'name' => 'min',
            'type' => 'string',
            'description' => 'Earliest allowed value, as "Y-m-d" or full "Y-m-d\TH:i". The date part bounds the calendar; the time part bounds the time of day on the boundary day.',
        ],
        [
            'name' => 'max',
            'type' => 'string',
            'description' => 'Latest allowed value, as "Y-m-d" or full "Y-m-d\TH:i". The date part bounds the calendar; the time part bounds the time of day on the boundary day.',
        ],
        [
            'name' => 'minNights',
            'type' => 'int',
            'description' => 'Range mode only. Minimum number of nights between the from and to dates.',
        ],
        [
            'name' => 'maxNights',
            'type' => 'int',
            'description' => 'Range mode only. Maximum number of nights between the from and to dates.',
        ],
        [
            'name' => 'outOfRange',
            'type' => 'string',
            'default' => "'disable'",
            'options' => ['disable', 'flag'],
            'description' => 'How to treat dates outside [min, max]: disable prevents picking them; flag allows the pick but shows a red error.',
        ],
        [
            'name' => 'weekStart',
            'type' => 'int',
            'default' => '0',
            'description' => 'First day of the week (0 = Sunday, 1 = Monday).',
        ],
        [
            'name' => 'numberOfMonths',
            'type' => 'int',
            'description' => 'Number of calendar months shown side by side. Defaults to 1 in single mode and 2 in range mode.',
        ],
        [
            'name' => 'defaultMonth',
            'type' => 'string',
            'description' => 'The month ("Y-m-d") the calendar opens on when there is no selected value.',
        ],
        [
            'name' => 'showOutsideDays',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show leading and trailing days from adjacent months to fill the calendar grid.',
        ],
        [
            'name' => 'width',
            'type' => 'string',
            'description' => 'Tailwind width class for the trigger and popover. Defaults to w-[280px] (single) or w-[320px] (range).',
        ],
    ],

    'shapes' => [
        'rangeValue' => [
            'label' => 'Range value',
            'fields' => [
                [
                    'name' => 'from',
                    'type' => 'string',
                    'description' => 'Start of the range, as "Y-m-d\TH:i" (or "Y-m-d H:i").',
                ],
                [
                    'name' => 'to',
                    'type' => 'string',
                    'description' => 'End of the range, as "Y-m-d\TH:i" (or "Y-m-d H:i").',
                ],
            ],
        ],
    ],
];
