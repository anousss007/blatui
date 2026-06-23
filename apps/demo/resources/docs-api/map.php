<?php

// API metadata for the map component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'lat',
            'type' => 'number',
            'description' => 'Latitude of the point to centre the map on. Defaults to Brussels (50.8467) when unset.',
        ],
        [
            'name' => 'lon',
            'type' => 'number',
            'description' => 'Longitude of the point to centre the map on. Defaults to Brussels (4.3499) when unset.',
        ],
        [
            'name' => 'zoom',
            'type' => 'int',
            'default' => '14',
            'description' => 'OpenStreetMap zoom level driving how tight the view is. Clamped to the 1-19 range; higher means closer.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Location'",
            'description' => 'Human-readable name of the place. Used in the iframe title and the "View larger map" link.',
        ],
        [
            'name' => 'marker',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Drop a pin at the lat/lon coordinates. Set false to show the area without a marker.',
        ],
        [
            'name' => 'height',
            'type' => 'int',
            'default' => '320',
            'description' => 'Fixed pixel height of the map frame. Ignored when ratio is set.',
        ],
        [
            'name' => 'ratio',
            'type' => 'string',
            'description' => 'A CSS aspect-ratio value (e.g. "16 / 9") for the frame. Overrides height when set, making the map responsive.',
        ],
    ],
];
