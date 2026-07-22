<?php

// API metadata for the popover component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'align',
            'type' => 'string',
            'default' => "'center'",
            'options' => ['center', 'start', 'end'],
            'description' => 'Set on <x-ui.popover-content>. Aligns the panel along the trigger edge it is anchored to.',
        ],
        [
            'name' => 'side',
            'type' => 'string',
            'default' => "'bottom'",
            'options' => ['top', 'right', 'bottom', 'left'],
            'description' => 'Set on <x-ui.popover-content>. Which edge of the trigger the panel opens from. Auto-flips if it would overflow the viewport.',
        ],
        [
            'name' => 'sideOffset',
            'type' => 'int',
            'default' => '4',
            'description' => 'Set on <x-ui.popover-content>. Gap in pixels between the trigger and the panel.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Popover'",
            'description' => 'Set on <x-ui.popover-content>. Accessible name (aria-label) for the dialog panel.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Place <x-ui.popover-trigger> and <x-ui.popover-content> here. The wrapper holds the shared open state.',
        ],
        [
            'name' => 'trigger',
            'description' => 'Content of <x-ui.popover-trigger> — the clickable element (usually a button) that toggles the popover.',
        ],
        [
            'name' => 'content',
            'description' => 'Content of <x-ui.popover-content> — the panel body shown when open. Teleported to <body> and anchored to the trigger.',
        ],
    ],

    'methods' => [
        [
            'name' => 'open',
            'description' => 'Reactive boolean on the shared Alpine scope. Set open = true / false from slot markup to control the panel programmatically.',
        ],
    ],
];
