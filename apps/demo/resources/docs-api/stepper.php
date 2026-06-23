<?php

// API metadata for the stepper component.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'int',
            'default' => '1',
            'description' => 'The active step (1-based). Exposed on the Alpine scope as `step`, so slot markup can read and update it (e.g. Previous / Next buttons) to drive navigation.',
        ],
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Whether steps lay out in a row or a column. Read by child items to switch their layout and the separator direction.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The stepper body. Compose with <x-ui.stepper-nav> wrapping <x-ui.stepper-item> entries (each holding <x-ui.stepper-trigger>, <x-ui.stepper-indicator>, optional <x-ui.stepper-title>/<x-ui.stepper-description>/<x-ui.stepper-separator>) plus any step content and controls. Everything shares the stepper scope, so controls can read/write `step` directly.',
        ],
    ],
];
