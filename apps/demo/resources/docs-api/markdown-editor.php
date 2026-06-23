<?php

// API metadata for the markdown-editor component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name for the underlying <textarea>. When set, the markdown source submits with the form under this name.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'Initial markdown source that seeds the editor.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Write markdown…'",
            'description' => 'Placeholder shown in the Write textarea while it is empty.',
        ],
        [
            'name' => 'rows',
            'type' => 'int',
            'default' => '8',
            'description' => 'Initial height of the Write textarea in rows. The textarea remains vertically resizable.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Base id used to wire the tabs, panels and textarea label. A random one is generated when omitted.',
        ],
    ],

    'methods' => [
        [
            'name' => 'bold()',
            'description' => 'Wraps the selection in ** for bold.',
        ],
        [
            'name' => 'italic()',
            'description' => 'Wraps the selection in * for italics.',
        ],
        [
            'name' => 'code()',
            'description' => 'Wraps the selection in backticks for inline code.',
        ],
        [
            'name' => 'insertLink()',
            'description' => 'Inserts a [text](url) link around the selection and selects the url placeholder.',
        ],
        [
            'name' => 'ul()',
            'description' => 'Prefixes each selected line with "- " to make a bulleted list.',
        ],
        [
            'name' => 'ol()',
            'description' => 'Numbers each selected line ("1. ", "2. "…) to make an ordered list.',
        ],
        [
            'name' => 'quote()',
            'description' => 'Prefixes each selected line with "> " to make a blockquote.',
        ],
    ],
];
