<?php

// API metadata for the hover-card component.

return [
    'props' => [
        [
            'name' => 'openDelay',
            'type' => 'int',
            'default' => '400',
            'description' => 'Milliseconds to wait after the pointer enters or the trigger is focused before the card opens.',
        ],
        [
            'name' => 'closeDelay',
            'type' => 'int',
            'default' => '100',
            'description' => 'Milliseconds to wait after the pointer leaves or focus moves out before the card closes. A short delay lets the pointer travel from trigger to card without it disappearing.',
        ],
        [
            'name' => 'align',
            'type' => 'string',
            'default' => "'center'",
            'options' => ['center', 'start', 'end'],
            'description' => 'Set on <x-ui.hover-card-content>. Alignment of the card along the chosen side.',
        ],
        [
            'name' => 'side',
            'type' => 'string',
            'default' => "'bottom'",
            'options' => ['bottom', 'top', 'left', 'right'],
            'description' => 'Set on <x-ui.hover-card-content>. Which side of the trigger the card is anchored to.',
        ],
        [
            'name' => 'sideOffset',
            'type' => 'int',
            'default' => '4',
            'description' => 'Set on <x-ui.hover-card-content>. Gap in pixels between the trigger and the card.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Holds the <x-ui.hover-card-trigger> and <x-ui.hover-card-content> sub-components. Hovering or focusing the trigger reveals the content.',
        ],
        [
            'name' => 'trigger',
            'description' => 'The hover/focus target. Pass any inline element (a link or button) inside <x-ui.hover-card-trigger>.',
        ],
        [
            'name' => 'content',
            'description' => 'The card body shown on hover, placed inside <x-ui.hover-card-content>. It is teleported to <body> and anchored to the trigger.',
        ],
    ],

    'methods' => [
        [
            'name' => 'show()',
            'description' => 'Schedules the card to open after openDelay (cancels any pending close).',
        ],
        [
            'name' => 'hide()',
            'description' => 'Schedules the card to close after closeDelay (cancels any pending open).',
        ],
    ],
];
