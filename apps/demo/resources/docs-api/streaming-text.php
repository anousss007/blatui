<?php

// API metadata for the streaming-text component.

return [
    'props' => [
        [
            'name' => 'text',
            'type' => 'string',
            'default' => "''",
            'description' => 'The full passage to reveal. If omitted, the slot content is used as the text instead.',
        ],
        [
            'name' => 'by',
            'type' => 'string',
            'default' => "'char'",
            'options' => ['char', 'word'],
            'description' => 'Reveal granularity: one character at a time, or whole words at a time.',
        ],
        [
            'name' => 'speed',
            'type' => 'int',
            'default' => '18',
            'description' => 'Milliseconds between each revealed chunk. Lower is faster.',
        ],
        [
            'name' => 'startDelay',
            'type' => 'int',
            'default' => '0',
            'description' => 'Milliseconds to wait after init before the first chunk appears.',
        ],
        [
            'name' => 'caret',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show a blinking caret at the end of the text while streaming. Hides once the passage finishes.',
        ],
        [
            'name' => 'autostart',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Begin streaming automatically on init. Set false to hold until you call start() from script.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Fallback source for the passage when the text prop is not set; its tags are stripped to plain text. The complete passage is also rendered up front in an sr-only aria-live region for screen readers, SEO, and no-JS.',
        ],
    ],

    'methods' => [
        [
            'name' => 'start()',
            'description' => 'Begins streaming from the current position. No-op if already started or finished; useful with autostart=false.',
        ],
        [
            'name' => 'finish()',
            'description' => 'Immediately reveals the full passage and marks the stream done.',
        ],
    ],
];
