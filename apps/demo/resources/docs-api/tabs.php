<?php

// API metadata for the tabs component.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'The value of the tab selected on load. Must match the value of one <x-ui.tabs-trigger> / <x-ui.tabs-content> pair.',
        ],
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Layout direction. Sets the arrow-key navigation axis on the tab list and is exposed to triggers and panels.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The tabs composition. Put triggers inside a single <x-ui.tabs-list> (each <x-ui.tabs-trigger value="…">, with optional disabled), then one <x-ui.tabs-content value="…"> per panel. Trigger and content values must match. <x-ui.tabs-list> takes a variant of segmented, underline or pills.',
        ],
    ],
];
