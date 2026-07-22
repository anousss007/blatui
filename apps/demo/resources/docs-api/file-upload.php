<?php

// API metadata for the file-upload component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'The name attribute of the hidden file input, so selected files submit with a form. With multiple, "[]" is appended.',
        ],
        [
            'name' => 'multiple',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Allow selecting more than one file.',
        ],
        [
            'name' => 'accept',
            'type' => 'string',
            'description' => 'The native accept filter (e.g. "image/*,.pdf"). Also shown in the dropzone hint line.',
        ],
        [
            'name' => 'maxSizeLabel',
            'type' => 'string',
            'description' => 'A human-readable size hint (e.g. "Up to 10MB") shown in the dropzone. Display only — not enforced.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the dropzone and the underlying input so no files can be added.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the hidden file input. A random id is generated when omitted.',
        ],
    ],

    'methods' => [
        [
            'name' => 'open()',
            'description' => 'Open the native file picker (the same action as clicking the dropzone).',
        ],
        [
            'name' => 'remove(index)',
            'description' => 'Remove the file at the given index from the list and revoke its preview URL.',
        ],
    ],
];
