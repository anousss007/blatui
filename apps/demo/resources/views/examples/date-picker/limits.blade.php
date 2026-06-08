{{-- A date range limited to a 2–14 night stay. Out-of-bounds selections show an error and
     keep the popover open until corrected. --}}
<x-ui.date-picker mode="range" name="stay" :min-nights="2" :max-nights="14" />
