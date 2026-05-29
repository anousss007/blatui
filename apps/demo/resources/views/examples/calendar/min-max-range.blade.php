{{-- Require a range of at least 2 and at most 7 nights --}}
<x-ui.calendar
    mode="range"
    :value="['from' => '2025-06-12', 'to' => '2025-06-16']"
    default-month="2025-06-12"
    :min="2"
    :max="7"
    class="rounded-md border shadow-sm"
/>
