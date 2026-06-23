<?php

// API metadata for the onboarding-tour component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'steps',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The ordered list of tour steps. Each step spotlights one element and shows a coachmark card.',
            'shape' => 'step',
        ],
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Start the tour immediately on page load. Prefer a "Start tour" trigger in the slot so the page is not covered on first paint.',
        ],
    ],

    'shapes' => [
        'step' => [
            'label' => 'Each step',
            'fields' => [
                [
                    'name' => 'target',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'A CSS selector (passed to querySelector) for the element to spotlight. If no element matches, the card centers and the spotlight is skipped for that step.',
                ],
                [
                    'name' => 'title',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The step heading. Also used as the dialog\'s accessible name.',
                ],
                [
                    'name' => 'body',
                    'type' => 'string',
                    'description' => 'The step description shown under the title.',
                ],
                [
                    'name' => 'placement',
                    'type' => 'string',
                    'default' => "'bottom'",
                    'options' => ['bottom', 'top', 'left', 'right'],
                    'description' => 'Preferred side of the target for the card. Auto-flips to the opposite side if it would overflow the viewport.',
                ],
            ],
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Your trigger UI (e.g. a "Start tour" button). It shares the tour\'s Alpine scope, so a child can call start() directly with no external wiring.',
        ],
    ],

    'methods' => [
        [
            'name' => 'start()',
            'description' => 'Resets to the first step and opens the tour.',
        ],
        [
            'name' => 'next()',
            'description' => 'Advances to the next step, or finishes the tour on the last step.',
        ],
        [
            'name' => 'back()',
            'description' => 'Returns to the previous step (no-op on the first step).',
        ],
        [
            'name' => 'end()',
            'description' => 'Closes the tour (the Skip button and Escape both call this).',
        ],
    ],
];
