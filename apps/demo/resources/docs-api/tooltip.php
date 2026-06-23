<?php

// API metadata for the tooltip component.

return [
    'props' => [
        [
            'name' => 'delay',
            'type' => 'int',
            'default' => '0',
            'description' => 'Milliseconds to wait after hover or focus before the tooltip opens.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The tooltip composition: an <x-ui.tooltip-trigger> wrapping the element that opens the tooltip, and an <x-ui.tooltip-content> holding the tooltip text. Content is teleported to <body> and anchored to the trigger.',
        ],
        [
            'name' => 'trigger',
            'description' => 'Use <x-ui.tooltip-trigger> for the hover/focus target. Wrap a button or any focusable element so keyboard users can reveal the tooltip.',
        ],
        [
            'name' => 'content',
            'description' => 'Use <x-ui.tooltip-content> for the floating panel. It accepts side (top, right, bottom, left), align (start, center, end), sideOffset (px) and arrow (bool). Recolor it by passing background/text classes via class.',
        ],
    ],

    'methods' => [
        [
            'name' => 'show()',
            'description' => 'Open the tooltip after the configured delay.',
        ],
        [
            'name' => 'hide()',
            'description' => 'Cancel any pending delay and close the tooltip immediately.',
        ],
    ],
];
