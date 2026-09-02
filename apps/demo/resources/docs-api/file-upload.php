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
            'name' => 'wire:model',
            'type' => 'string',
            'description' => 'Bind to a Livewire property (with the WithFileUploads trait). Livewire uploads the selection — picked or dropped — and the per-file bar reports its real progress, turning into an error message if the upload fails. Without it nothing is uploading, so no bar is drawn and the files ride along with the surrounding form.',
        ],
        [
            'name' => 'maxSizeLabel',
            'type' => 'string',
            'description' => 'A human-readable size hint (e.g. "Up to 10MB") shown in the dropzone. Display only — not enforced.',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'description' => 'The file(s) the field already holds — what an edit form has saved against the record. A URL, a list of URLs, or maps with url/name/size/image. Each becomes an ordinary row with the same thumbnail and the same remove button, so the preview does not have to be rebuilt outside the component. Removing one dispatches file-remove; the component cannot delete a file it did not upload.',
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
            'description' => 'Id for the hidden file input. None is generated when omitted — a per-render id would be a per-render morph key, and Livewire would replace the input mid-upload.',
        ],
    ],

    'methods' => [
        [
            'name' => 'open()',
            'description' => 'Open the native file picker (the same action as clicking the dropzone).',
        ],
        [
            'name' => 'remove(index)',
            'description' => 'Remove the file at the given index: drops the row, revokes its preview URL, withdraws the temporary Livewire upload (or takes the file back off the native input when there is no wire:model). A row that came from value is only announced — see file-remove.',
        ],
    ],

    'events' => [
        [
            'name' => 'file-remove',
            'direction' => 'out',
            'detail' => '{ url, name }',
            'description' => 'A row that came from value was removed. The file is already saved and is not the component\'s to delete, so this is how it says so — listen for it to clear the column on your record.',
        ],
    ],
];
