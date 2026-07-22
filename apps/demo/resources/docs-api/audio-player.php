<?php

// API metadata for the audio-player component.

return [
    'props' => [
        [
            'name' => 'src',
            'type' => 'string',
            'description' => 'Audio file URL. Loaded with preload="metadata" so the duration is known before playback starts.',
        ],
        [
            'name' => 'title',
            'type' => 'string',
            'description' => 'Optional track title shown above the controls.',
        ],
        [
            'name' => 'artist',
            'type' => 'string',
            'description' => 'Optional artist or subtitle shown under the title.',
        ],
        [
            'name' => 'autoplay',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Start playing on load. Most browsers require the audio to be muted to honour this, so the player starts muted when autoplay is on.',
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle()',
            'description' => 'Plays the audio if paused, or pauses it if playing.',
        ],
        [
            'name' => 'seek(v)',
            'description' => 'Jumps to a position given as a 0-100 percentage of the total duration.',
        ],
        [
            'name' => 'setVolume(v)',
            'description' => 'Sets the volume from a 0-100 value, muting when 0.',
        ],
        [
            'name' => 'toggleMute()',
            'description' => 'Toggles muted state without changing the volume level.',
        ],
    ],
];
