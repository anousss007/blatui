<x-ui.scheduler
    :start-hour="8"
    :end-hour="18"
    :events="[
        ['title' => 'Standup',        'day' => 0, 'start' => '09:00', 'end' => '09:30', 'color' => 'sky'],
        ['title' => 'Design review',  'day' => 0, 'start' => '11:00', 'end' => '12:30'],
        ['title' => 'Lunch & learn',  'day' => 1, 'start' => '12:00', 'end' => '13:00', 'color' => 'emerald'],
        ['title' => '1:1 with Sam',   'day' => 2, 'start' => '10:00', 'end' => '10:45', 'color' => 'amber'],
        ['title' => 'Sprint planning','day' => 3, 'start' => '14:00', 'end' => '16:00', 'color' => 'violet'],
        ['title' => 'Demo day',       'day' => 4, 'start' => '15:30', 'end' => '17:00', 'color' => 'rose'],
        ['title' => 'Retro',          'day' => 4, 'start' => '09:30', 'end' => '10:30'],
    ]"
/>
