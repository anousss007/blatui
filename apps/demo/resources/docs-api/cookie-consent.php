<?php

// API metadata for the cookie-consent component.

return [
    'props' => [
        [
            'name' => 'position',
            'type' => 'string',
            'default' => "'bottom'",
            'options' => ['bottom', 'bottom-start', 'bottom-end', 'top'],
            'description' => 'Where the fixed banner sits on the page. Ignored when demo is true (the banner renders in-flow). "bottom" and "top" are wide centered bars; the corner placements are narrower cards.',
        ],
        [
            'name' => 'customizable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show a "Customize" toggle that reveals per-category switches (necessary, analytics, marketing) and a "Save preferences" button.',
        ],
        [
            'name' => 'demo',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render in-flow (static, always visible) and ignore localStorage, so the banner always shows. Use for docs and previews; leave false in production so the choice persists.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Optional replacement for the default consent message. When empty, a built-in privacy blurb is shown. A "Cookie policy" link is always appended after your text.',
        ],
    ],

    'methods' => [
        [
            'name' => 'acceptAll()',
            'description' => 'Turns on every category, persists the choice, and hides the banner.',
        ],
        [
            'name' => 'reject()',
            'description' => 'Keeps only the locked (necessary) categories on, persists the choice, and hides the banner.',
        ],
        [
            'name' => 'savePrefs()',
            'description' => 'Persists the current per-category switch selections and hides the banner.',
        ],
    ],
];
