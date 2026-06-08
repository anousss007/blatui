{{-- 24-hour clock with dropdowns: hours 00–23, no AM/PM segment.
     Same on the datetime-picker: time-variant="select" hour-cycle="24". --}}
<x-ui.time-field name="time" value="14:15" variant="select" hour-cycle="24" :minute-step="5" />
