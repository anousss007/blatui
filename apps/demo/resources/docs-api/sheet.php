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
            'name' => 'wire:model',
            'type' => 'bool',
            'description' => 'Since 1.38. Set on <x-ui.sheet>. Binds the open state to a Livewire boolean property, both ways: `$this->open = true` opens it from the server, and closing it (Escape, the overlay, a close button) sets the property back to false. Opening it from the browser with `$wire.open = true` sends no request at all. Deferred like any wire:model; .live sends every change.',
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
            'name' => 'closeOnOverlay',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Since 1.21. Set on <x-ui.sheet-content>. Clicking the backdrop closes the sheet. Pass false for a "static backdrop" — a form a stray click should not discard. Escape and the close button are unaffected.',
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
    'events' => [
        [
            'name' => 'sheet-closed',
            'direction' => 'out',
            'description' => 'Since 1.38. Dispatched from the <x-ui.sheet> root once it has finished closing and is off screen, whatever closed it. The place to reset a form: on open = false the fade-out is still playing, and a reset that lands then empties the fields in front of the user. Listen with x-on:sheet-closed or wire:sheet-closed="resetForm" on the root; it bubbles, so add .self when sheets are nested.',
        ],
    ],
];
