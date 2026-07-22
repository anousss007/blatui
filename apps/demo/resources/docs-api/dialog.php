<?php

// API metadata for the dialog component.

return [
    'props' => [
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Initial open state of the dialog on first render.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Enables "dispatchable" mode: the dialog also opens/closes from anywhere via $dispatch(\'open-dialog-{id}\') / $dispatch(\'close-dialog-{id}\'). Lets a trigger inside a loop or partial drive a single shared modal defined elsewhere (pair with <x-ui.dialog-trigger for="{id}">).',
        ],
        [
            'name' => 'showClose',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Set on <x-ui.dialog-content>. Render the built-in top-right close (X) button.',
        ],
        [
            'name' => 'fullscreen',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.dialog-content>. Render the dialog edge-to-edge (inset-0) instead of a centered box — useful for mobile-style takeovers, editors, and media viewers.',
        ],
        [
            'name' => 'position',
            'type' => 'string',
            'default' => "'center'",
            'options' => ['center', 'top', 'bottom', 'left', 'right', 'top-left', 'top-right', 'bottom-left', 'bottom-right'],
            'description' => 'Set on <x-ui.dialog-content>. Where the box sits within the viewport.',
        ],
        [
            'name' => 'for',
            'type' => 'string',
            'description' => 'Set on <x-ui.dialog-trigger>. Opens a dispatchable dialog defined elsewhere (matching its id) instead of one in the same scope.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Holds the <x-ui.dialog-trigger> and <x-ui.dialog-content>. The root only manages open state.',
        ],
        [
            'name' => 'trigger',
            'description' => 'The clickable element that opens the dialog, wrapped in <x-ui.dialog-trigger>.',
        ],
        [
            'name' => 'content',
            'description' => 'The modal panel (<x-ui.dialog-content>), teleported to <body>. Compose it from <x-ui.dialog-header> (with <x-ui.dialog-title> + <x-ui.dialog-description>), your body, and <x-ui.dialog-footer>.',
        ],
        [
            'name' => 'close',
            'description' => 'Wrap any element in <x-ui.dialog-close> to make it dismiss the dialog (in addition to the built-in X, Escape, and overlay click).',
        ],
    ],
];
