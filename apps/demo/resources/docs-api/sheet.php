<?php

// API metadata for the sheet component.

return [
    'props' => [
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Initial open state of the sheet on first render.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Enables "dispatchable" mode: the sheet also opens/closes from anywhere via $dispatch(\'open-sheet-{id}\') / $dispatch(\'close-sheet-{id}\'). Use <x-ui.sheet-trigger for="{id}"> from inside a loop or partial.',
        ],
        [
            'name' => 'side',
            'type' => 'string',
            'default' => "'right'",
            'options' => ['right', 'left', 'top', 'bottom'],
            'description' => 'Set on <x-ui.sheet-content>. Which edge of the viewport the panel slides in from.',
        ],
        [
            'name' => 'showClose',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Set on <x-ui.sheet-content>. Render the built-in top-right close (X) button.',
        ],
        [
            'name' => 'for',
            'type' => 'string',
            'description' => 'Set on <x-ui.sheet-trigger>. Opens a dispatchable sheet defined elsewhere (matching its id) instead of one in the same scope.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Holds the <x-ui.sheet-trigger> and <x-ui.sheet-content>. The root only manages open state.',
        ],
        [
            'name' => 'trigger',
            'description' => 'The clickable element that opens the sheet, wrapped in <x-ui.sheet-trigger>.',
        ],
        [
            'name' => 'content',
            'description' => 'The sliding panel (<x-ui.sheet-content>), teleported to <body>. Compose it from <x-ui.sheet-header> (with <x-ui.sheet-title> + <x-ui.sheet-description>), your body, and <x-ui.sheet-footer>. Dismisses on overlay click, Escape, or the close button.',
        ],
    ],
];
