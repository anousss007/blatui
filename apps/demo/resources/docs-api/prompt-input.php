<?php

// API metadata for the prompt-input component.

return [
    'props' => [
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Send a message…'",
            'description' => 'Placeholder text shown in the empty textarea.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'The name attribute for the textarea, so its value is submitted when the component is inside a <form>.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'The id attribute for the textarea, e.g. to pair it with an external <label>.',
        ],
        [
            'name' => 'attachable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show an "Attach file" paperclip button in the toolbar. The button is presentational; wire your own upload handling to it.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the textarea and toolbar buttons and block submit().',
        ],
        [
            'name' => 'rows',
            'type' => 'int',
            'default' => '1',
            'description' => 'Initial visible row count of the textarea before it auto-grows with content.',
        ],
        [
            'name' => 'maxRows',
            'type' => 'int',
            'default' => '6',
            'description' => 'Maximum rows the textarea grows to before it starts scrolling internally.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Not used for content — the component renders its own auto-resizing textarea and toolbar. Pass aria-label as an attribute to name the textarea (defaults to "Message"). Inside a <form>, ⌘/Ctrl+Enter or the send button submits the form; otherwise it dispatches a bubbling "submit" event with detail.value carrying the trimmed text.',
        ],
    ],

    'methods' => [
        [
            'name' => 'submit()',
            'description' => 'Submits the prompt: requests the enclosing form\'s submit, or dispatches a bubbling "submit" CustomEvent with the trimmed value. No-op while disabled or empty.',
        ],
    ],
];
