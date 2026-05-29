{{-- Disable everything before June 12, 2025 --}}
<x-ui.calendar
    mode="single"
    value="2025-06-12"
    default-month="2025-06-12"
    :disabled="['before' => '2025-06-12']"
    class="rounded-md border shadow-sm"
/>
