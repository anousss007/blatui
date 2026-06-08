{{-- Range constrained to 2–14 nights, inside [Jun 1 .. Jul 31], with end ≥ start.
     Any invalid selection shows an inline error and disables "Done". --}}
<x-ui.datetime-picker
    mode="range"
    name="stay"
    min="2026-06-01"
    max="2026-07-31"
    :min-nights="2"
    :max-nights="14"
    hour-cycle="24"
/>
