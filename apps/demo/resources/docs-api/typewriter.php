<?php

// API metadata for the typewriter component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'words',
            'type' => 'array',
            'default' => '[]',
            'description' => 'The phrases to type and delete in a cycle. When empty, the trimmed slot text is used as the single word.',
        ],
        [
            'name' => 'typeSpeed',
            'type' => 'int',
            'default' => '90',
            'description' => 'Milliseconds per typed character.',
        ],
        [
            'name' => 'deleteSpeed',
            'type' => 'int',
            'default' => '40',
            'description' => 'Milliseconds per deleted character.',
        ],
        [
            'name' => 'pause',
            'type' => 'int',
            'default' => '1600',
            'description' => 'Milliseconds to hold a fully typed word before deleting it.',
        ],
        [
            'name' => 'loop',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Cycle through the words forever. When false, typing stops on the last word.',
        ],
        [
            'name' => 'cursor',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the blinking caret next to the text.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Fallback text used as the single word when words is empty. The animated text is aria-hidden and a visually-hidden span carries the full word list, so assistive tech reads the content once. Shows the first word statically under prefers-reduced-motion.',
        ],
    ],
];
