<?php

// API metadata for the notification-center component.

return [
    'props' => [
        [
            'name' => 'notifications',
            'type' => 'array',
            'default' => '[]',
            'description' => 'The list of notifications to render in the panel. Pass an empty array to show the built-in "all caught up" empty state.',
            'shape' => 'notification',
        ],
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the panel starts open on load. Intended for demos so the inbox is visible; leave false in production so the page is not covered.',
        ],
    ],

    'shapes' => [
        'notification' => [
            'label' => 'Each notification',
            'fields' => [
                [
                    'name' => 'title',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The notification headline, shown in bold as the first line of the row.',
                ],
                [
                    'name' => 'body',
                    'type' => 'string',
                    'description' => 'Optional supporting text shown under the title.',
                ],
                [
                    'name' => 'time',
                    'type' => 'string',
                    'description' => 'A human-readable timestamp (e.g. "2 minutes ago") shown as the last line. Formatted by you; rendered verbatim.',
                ],
                [
                    'name' => 'read',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Whether the item starts read. Unread items get an accent bar, a tinted background and a dot, and count toward the trigger badge.',
                ],
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'description' => 'A lucide icon name (without the "lucide-" prefix) shown as the leading visual when no avatar is given. Falls back to a bell.',
                ],
                [
                    'name' => 'avatar',
                    'type' => 'string',
                    'description' => 'An image URL shown as a round leading avatar. Takes precedence over icon.',
                ],
            ],
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle()',
            'description' => 'Opens the panel if closed, closes it if open.',
        ],
        [
            'name' => 'openPanel()',
            'description' => 'Opens the panel and moves focus into it.',
        ],
        [
            'name' => 'close(returnFocus = true)',
            'description' => 'Closes the panel; by default returns focus to the bell trigger.',
        ],
        [
            'name' => 'markRead(i)',
            'description' => 'Marks the notification at index i as read.',
        ],
        [
            'name' => 'markAllRead()',
            'description' => 'Marks every notification as read and clears the unread badge.',
        ],
    ],
];
