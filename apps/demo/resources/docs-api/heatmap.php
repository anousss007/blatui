<?php

// API metadata for the heatmap component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'data',
            'type' => '[date => int]|int[]',
            'default' => '[]',
            'description' => 'The activity counts to plot. Either an associative map of "YYYY-MM-DD" => count (sorted chronologically and used in tooltips) or a flat list of integer counts. When empty, deterministic demo data is shown.',
        ],
        [
            'name' => 'levels',
            'type' => 'int[]',
            'description' => 'Optional ascending count thresholds that split cells into the four shaded levels, e.g. [1, 3, 6, 9]. Only the first four are used. Defaults to quartile-style thresholds derived from the highest count.',
        ],
    ],
];
