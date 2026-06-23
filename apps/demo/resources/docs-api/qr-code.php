<?php

// API metadata for the qr-code component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'required' => true,
            'description' => 'The text or URL to encode. Encoded in byte mode over UTF-8 with automatic version selection.',
        ],
        [
            'name' => 'size',
            'type' => 'int',
            'default' => '160',
            'description' => 'Rendered width and height of the code in pixels. The SVG scales crisply to this size.',
        ],
        [
            'name' => 'ecc',
            'type' => 'string',
            'default' => "'M'",
            'options' => ['L', 'M', 'Q', 'H'],
            'description' => 'Error-correction level. Higher levels (Q, H) survive more damage or overlay but produce a denser code. Invalid values fall back to M.',
        ],
        [
            'name' => 'margin',
            'type' => 'int',
            'default' => '4',
            'description' => 'Quiet-zone width in modules around the code. 4 is the QR spec minimum needed for reliable scanning.',
        ],
        [
            'name' => 'alt',
            'type' => 'string',
            'description' => 'Accessible label for the SVG (role="img"). Defaults to "QR code for {value}" when unset.',
        ],
    ],
];
