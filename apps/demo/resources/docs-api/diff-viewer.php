<?php

// API metadata for the diff-viewer component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'old',
            'type' => 'string',
            'default' => "''",
            'description' => 'The original text. Compared against new with a line-level LCS diff; an empty string is treated as zero lines so pure additions diff cleanly.',
        ],
        [
            'name' => 'new',
            'type' => 'string',
            'default' => "''",
            'description' => 'The changed text. Added lines are highlighted in green, removed lines in red.',
        ],
        [
            'name' => 'mode',
            'type' => 'string',
            'default' => "'inline'",
            'options' => ['inline', 'split'],
            'description' => 'Layout of the diff. "inline" stacks removals and additions in one column; "split" shows original and changed side by side.',
        ],
        [
            'name' => 'filename',
            'type' => 'string',
            'description' => 'Optional label shown in a header bar above the diff (e.g. the file path).',
        ],
    ],
];
