<?php

// API metadata for the speed-dial component.

return [
    'props' => [
        [
            'name' => 'actions',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The action buttons revealed when the dial expands, stacked in order from the main FAB.',
            'shape' => 'action',
        ],
        [
            'name' => 'direction',
            'type' => 'string',
            'default' => "'up'",
            'options' => ['up', 'down'],
            'description' => 'Which way the actions stack from the floating action button.',
        ],
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Start the dial expanded. Useful for previews or always-open dials; otherwise it opens on click.',
        ],
        [
            'name' => 'icon',
            'type' => 'string',
            'default' => "'plus'",
            'description' => 'Lucide icon name for the main FAB. Rotates ~45 degrees while the dial is open.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Open actions'",
            'description' => 'Accessible label for the main floating action button.',
        ],
    ],

    'shapes' => [
        'action' => [
            'label' => 'Each action',
            'fields' => [
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'description' => 'Lucide icon name shown inside the round action button.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'Accessible name and the text shown in the label pill beside the button. Falls back to "Action N" if omitted.',
                ],
                [
                    'name' => 'href',
                    'type' => 'string',
                    'description' => 'Link target. When set the action renders as an <a>; otherwise it is a <button>.',
                ],
            ],
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle()',
            'description' => 'Toggles the dial open or closed.',
        ],
        [
            'name' => 'close()',
            'description' => 'Closes the dial (also triggered by Escape, click-outside, and selecting an action).',
        ],
    ],
];
