<?php

// API metadata for the calendar component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'mode',
            'type' => 'string',
            'default' => "'single'",
            'options' => ['single', 'multiple', 'range'],
            'description' => 'Selection behaviour: one date, a set of dates, or a start/end range.',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'description' => 'The initial selection. A "Y-m-d" string for single mode, an array of "Y-m-d" strings for multiple, or ["from"=>, "to"=>] for range.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'When set, renders hidden inputs with this name so the selection submits with a form. Range mode emits name[from] and name[to].',
        ],
        [
            'name' => 'numberOfMonths',
            'type' => 'int',
            'default' => '1',
            'description' => 'How many month grids to render side by side.',
        ],
        [
            'name' => 'defaultMonth',
            'type' => 'string',
            'description' => 'The "Y-m-d" date whose month is shown first when there is no value.',
        ],
        [
            'name' => 'weekStart',
            'type' => 'int|string',
            'default' => '0',
            'description' => 'First day of the week: 0–6 (0 = Sunday) or a day name like "monday".',
        ],
        [
            'name' => 'captionLayout',
            'type' => 'string',
            'default' => "'label'",
            'options' => ['label', 'dropdown'],
            'description' => 'Render the month/year caption as plain text or as selectable dropdowns.',
        ],
        [
            'name' => 'showWeekNumber',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show an ISO week-number column on the left of each grid.',
        ],
        [
            'name' => 'showOutsideDays',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Render days from adjacent months that pad the first and last week.',
        ],
        [
            'name' => 'locale',
            'type' => 'string',
            'description' => 'BCP-47 locale (e.g. "en-GB") for month names, weekday labels, and date formatting.',
        ],
        [
            'name' => 'disabled',
            'type' => 'array',
            'description' => 'Matcher(s) describing which dates cannot be selected.',
            'shape' => 'matcher',
        ],
        [
            'name' => 'minDate',
            'type' => 'string',
            'description' => 'Earliest selectable date ("Y-m-d"). Behaviour with later dates is governed by outOfRange.',
        ],
        [
            'name' => 'maxDate',
            'type' => 'string',
            'description' => 'Latest selectable date ("Y-m-d"). Behaviour with earlier dates is governed by outOfRange.',
        ],
        [
            'name' => 'outOfRange',
            'type' => 'string',
            'default' => "'disable'",
            'options' => ['disable', 'flag'],
            'description' => 'How to treat dates outside minDate/maxDate: prevent selection, or allow it but flag the day in red.',
        ],
        [
            'name' => 'min',
            'type' => 'int',
            'description' => 'Range mode only: minimum range length in days. Alias of minDays.',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'description' => 'Range mode only: maximum range length in days. Alias of maxDays. In multiple mode it caps the number of selectable dates.',
        ],
        [
            'name' => 'minDays',
            'type' => 'int',
            'description' => 'Range mode only: minimum range length in days (clearer name for min).',
        ],
        [
            'name' => 'maxDays',
            'type' => 'int',
            'description' => 'Range mode only: maximum range length in days (clearer name for max).',
        ],
        [
            'name' => 'startMonth',
            'type' => 'string',
            'description' => 'Earliest navigable month ("Y-m-d"); the previous-month button stops here.',
        ],
        [
            'name' => 'endMonth',
            'type' => 'string',
            'description' => 'Latest navigable month ("Y-m-d"); the next-month button stops here.',
        ],
        [
            'name' => 'disableNavigation',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Hide/disable the previous and next month controls.',
        ],
        [
            'name' => 'buttonVariant',
            'type' => 'string',
            'default' => "'ghost'",
            'options' => ['ghost', 'outline'],
            'description' => 'Visual style of the month navigation buttons.',
        ],
        [
            'name' => 'required',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Prevent clearing the selection by clicking the currently selected day.',
        ],
        [
            'name' => 'modifiers',
            'type' => 'array',
            'description' => 'Map of modifier name to a matcher (same shape as disabled). Tags matching days so they can be styled.',
        ],
        [
            'name' => 'modifiersClass',
            'type' => '[modifier => class]',
            'description' => 'Map of modifier name to the Tailwind classes applied to days that match that modifier.',
        ],
    ],

    'shapes' => [
        'matcher' => [
            'label' => 'Disabled / modifier matchers',
            'fields' => [
                [
                    'name' => 'before',
                    'type' => 'string',
                    'description' => 'Match every date before this "Y-m-d" date.',
                ],
                [
                    'name' => 'after',
                    'type' => 'string',
                    'description' => 'Match every date after this "Y-m-d" date.',
                ],
                [
                    'name' => 'dayOfWeek',
                    'type' => 'array',
                    'description' => 'Match these weekdays (0 = Sunday … 6 = Saturday), e.g. [0, 6] for weekends.',
                ],
                [
                    'name' => 'from',
                    'type' => 'string',
                    'description' => 'Start of an inclusive ["Y-m-d", "Y-m-d"] date range to match (paired with to).',
                ],
                [
                    'name' => 'to',
                    'type' => 'string',
                    'description' => 'End of an inclusive date range to match (paired with from).',
                ],
            ],
        ],
    ],
];
