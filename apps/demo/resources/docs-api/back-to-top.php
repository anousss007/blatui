<?php

// API metadata for the back-to-top component.

return [
    'props' => [
        [
            'name' => 'threshold',
            'type' => 'int',
            'default' => '300',
            'description' => 'How far the window must be scrolled (in pixels) before the button reveals itself.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'primary'",
            'options' => ['primary', 'subtle'],
            'description' => 'Visual style: a filled primary button or a subtle card-with-border button.',
        ],
        [
            'name' => 'demo',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Docs-only. Pins the button static and always visible so it shows inside a non-scrolling preview frame. Leave false in real use, where it floats fixed at the bottom-end corner.',
        ],
    ],

    'methods' => [
        [
            'name' => 'toTop()',
            'description' => 'Scrolls the window back to the top (smoothly, or instantly under prefers-reduced-motion).',
        ],
    ],
];
