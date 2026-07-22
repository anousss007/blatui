{{-- Bounded by a full datetime: nothing before Jun 10, 09:00 or after Jun 20, 17:00.
     The calendar disables out-of-window days; on the edge days the time bound is enforced
     (an error shows and "Done" is disabled until the selection is valid). --}}
<x-ui.datetime-picker
    name="slot"
    min="2026-06-10T09:00"
    max="2026-06-20T17:00"
    time-variant="select"
    hour-cycle="24"
/>
