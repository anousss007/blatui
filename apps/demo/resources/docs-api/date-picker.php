<?php

// API metadata for the date-picker component.

return [
    'props' => [
        [
            'name' => 'mode',
            'type' => 'string',
            'default' => "'single'",
            'options' => ['single', 'range'],
            'description' => 'Pick one date or a from–to range. Range submits two values and shows two months by default.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name for the hidden input. In range mode it submits as name[from] and name[to]; otherwise a single name.',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'description' => 'Initial selection. Single mode: a "Y-m-d" string. Range mode: an array shaped [\'from\' => "Y-m-d", \'to\' => "Y-m-d"].',
            'shape' => 'rangeValue',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Trigger text shown when nothing is selected. Defaults to "Pick a date" (single) or "Pick a date range" (range).',
        ],
        [
            'name' => 'numberOfMonths',
            'type' => 'int',
            'description' => 'Number of calendar months shown side by side. Defaults to 1 in single mode and 2 in range mode.',
        ],
        [
            'name' => 'captionLayout',
            'type' => 'string',
            'default' => "'label'",
            'options' => ['label', 'dropdown'],
            'description' => 'Calendar header style: a static month/year label, or month/year dropdowns for fast navigation.',
        ],
        [
            'name' => 'weekStart',
            'type' => 'int',
            'default' => '0',
            'description' => 'First day of the week (0 = Sunday, 1 = Monday).',
        ],
        [
            'name' => 'defaultMonth',
            'type' => 'string',
            'description' => 'The month ("Y-m-d") the calendar opens on when there is no selected value.',
        ],
        [
            'name' => 'min',
            'type' => 'string',
            'description' => 'Earliest selectable date ("Y-m-d"). Dates before it are disabled (or flagged, per outOfRange).',
        ],
        [
            'name' => 'max',
            'type' => 'string',
            'description' => 'Latest selectable date ("Y-m-d"). Dates after it are disabled (or flagged, per outOfRange).',
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
            'name' => 'showOutsideDays',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show leading and trailing days from adjacent months to fill the calendar grid.',
        ],
        [
            'name' => 'width',
            'type' => 'string',
            'description' => 'Tailwind width class for the trigger and popover. Defaults to w-[240px] (single) or w-[300px] (range).',
        ],
    ],

    'shapes' => [
        'rangeValue' => [
            'label' => 'Range value',
            'fields' => [
                [
                    'name' => 'from',
                    'type' => 'string',
                    'description' => 'Start date of the range, as "Y-m-d".',
                ],
                [
                    'name' => 'to',
                    'type' => 'string',
                    'description' => 'End date of the range, as "Y-m-d".',
                ],
            ],
        ],
    ],
];
