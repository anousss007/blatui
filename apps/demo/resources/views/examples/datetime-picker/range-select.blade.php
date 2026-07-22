{{-- Range, with each end's TIME chosen via dropdowns (time-variant="select") instead of the
     native time input. The calendar picks the day range; the Start/End selects set the time.
     Works the same in single mode — set time-variant on any <x-ui.datetime-picker>. --}}
<x-ui.datetime-picker
    mode="range"
    name="shift"
    time-variant="select"
    hour-cycle="24"
    :value="['from' => '2026-06-06T09:00', 'to' => '2026-06-06T17:30']"
/>
