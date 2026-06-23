<?php

// API metadata for the rich-text-editor component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. When set, a hidden <textarea> is rendered that mirrors the editor HTML, so the content submits with the form under this name.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'Initial HTML content rendered into the editable area (printed unescaped). Use it to seed an existing document.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Write something…'",
            'description' => 'Placeholder shown while the editor is empty. Also used as the textbox\'s accessible name.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the editable region. A random one is generated when omitted.',
        ],
    ],

    'methods' => [
        [
            'name' => 'run(cmd)',
            'description' => 'Runs an execCommand (bold, italic, underline, strikeThrough, insertUnorderedList, insertOrderedList) on the current selection, then refreshes toolbar state.',
        ],
        [
            'name' => 'block(tag)',
            'description' => 'Wraps the current block in the given tag via formatBlock (e.g. h1, h2, p).',
        ],
        [
            'name' => 'link()',
            'description' => 'Prompts for a URL and turns the selected text into a link.',
        ],
        [
            'name' => 'clear()',
            'description' => 'Removes inline formatting and unlinks the current selection.',
        ],
        [
            'name' => 'sync()',
            'description' => 'Copies the editor HTML into the hidden form <textarea>. Runs automatically on input and after each command.',
        ],
    ],
];
