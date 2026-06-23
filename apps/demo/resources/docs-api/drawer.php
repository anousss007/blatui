<?php

// API metadata for the drawer component.

return [
    'props' => [
        [
            'name' => 'direction',
            'type' => 'string',
            'default' => "'bottom'",
            'options' => ['bottom', 'top', 'right', 'left'],
            'description' => 'Which edge of the viewport the drawer slides in from. A drag-handle bar is shown only for the "bottom" direction.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Holds the <x-ui.drawer-trigger> and <x-ui.drawer-content>. The root only manages open state and the slide direction.',
        ],
        [
            'name' => 'trigger',
            'description' => 'The clickable element that opens the drawer, wrapped in <x-ui.drawer-trigger>.',
        ],
        [
            'name' => 'content',
            'description' => 'The sliding panel (<x-ui.drawer-content>), teleported to <body>. Compose it from <x-ui.drawer-header> (with <x-ui.drawer-title> + <x-ui.drawer-description>), your body, and <x-ui.drawer-footer>. Dismisses on overlay click or Escape.',
        ],
        [
            'name' => 'close',
            'description' => 'Wrap any element in <x-ui.drawer-close> to make it dismiss the drawer.',
        ],
    ],
];
