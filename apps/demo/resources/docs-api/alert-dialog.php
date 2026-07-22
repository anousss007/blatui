<?php

// API metadata for the alert-dialog component.

return [
    'props' => [
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Initial open state of the confirm dialog on first render.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Enables "dispatchable" mode: opens/closes from anywhere via $dispatch(\'open-alert-dialog-{id}\') / $dispatch(\'close-alert-dialog-{id}\'). Ideal for a single shared confirm driven by per-row delete buttons in a loop (pair with <x-ui.alert-dialog-trigger for="{id}">). Pass row context in the event detail and read it from $event.detail.',
        ],
        [
            'name' => 'for',
            'type' => 'string',
            'description' => 'Set on <x-ui.alert-dialog-trigger>. Opens a dispatchable alert-dialog defined elsewhere (matching its id) instead of one in the same scope.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Holds the <x-ui.alert-dialog-trigger> and <x-ui.alert-dialog-content>. The root only manages open state.',
        ],
        [
            'name' => 'trigger',
            'description' => 'The clickable element that opens the confirm, wrapped in <x-ui.alert-dialog-trigger>.',
        ],
        [
            'name' => 'content',
            'description' => 'The modal panel (<x-ui.alert-dialog-content>), teleported to <body>. Unlike a dialog it has no close button and no overlay-click dismiss — the user must choose an action. Compose it from <x-ui.alert-dialog-header>, <x-ui.alert-dialog-footer>, and a <x-ui.alert-dialog-cancel> / <x-ui.alert-dialog-action> pair.',
        ],
        [
            'name' => 'cancel',
            'description' => 'The dismiss button (<x-ui.alert-dialog-cancel>) styled as an outline button; closes the dialog after running any @click you add.',
        ],
        [
            'name' => 'action',
            'description' => 'The confirm button (<x-ui.alert-dialog-action>) styled as a primary button; runs any @click you add, then closes the dialog.',
        ],
    ],
];
