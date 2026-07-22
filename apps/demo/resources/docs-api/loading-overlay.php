<?php

// API metadata for the loading-overlay component.

return [
    'props' => [
        [
            'name' => 'show',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the veil is shown over the content. Sets the initial state; drive it reactively from a parent scope (e.g. x-effect="show = loading") to toggle it at runtime.',
        ],
        [
            'name' => 'message',
            'type' => 'string',
            'description' => 'Text shown under the spinner and announced to assistive tech. Defaults to "Loading…" when omitted.',
        ],
        [
            'name' => 'blur',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Apply a backdrop blur to the veil behind the spinner.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The content the overlay covers while busy. The wrapper is position:relative, so the veil is absolutely positioned over exactly this content.',
        ],
    ],
];
