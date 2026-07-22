<x-ui.scheduler
    view="day"
    :days="['Wednesday']"
    :start-hour="8"
    :end-hour="17"
    label="Wednesday schedule"
    class="max-w-md"
    :events="[
        ['title' => 'Inbox & triage',  'day' => 0, 'start' => '08:30', 'end' => '09:00', 'color' => 'sky'],
        ['title' => 'Pairing session', 'day' => 0, 'start' => '09:00', 'end' => '10:30'],
        ['title' => 'Coffee chat',     'day' => 0, 'start' => '10:30', 'end' => '11:00', 'color' => 'amber'],
        ['title' => 'Focus block',     'day' => 0, 'start' => '11:00', 'end' => '12:30', 'color' => 'violet'],
        ['title' => 'Lunch',           'day' => 0, 'start' => '12:30', 'end' => '13:30', 'color' => 'emerald'],
        ['title' => 'Client call',     'day' => 0, 'start' => '14:00', 'end' => '15:00', 'color' => 'rose'],
        ['title' => 'Wrap-up notes',   'day' => 0, 'start' => '16:00', 'end' => '16:30'],
    ]"
/>
