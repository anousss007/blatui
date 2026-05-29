{{-- dayOfWeek: 0 = Sunday, 6 = Saturday --}}
<x-ui.calendar
    mode="single"
    default-month="2025-06-01"
    :disabled="['dayOfWeek' => [0, 6]]"
    class="rounded-md border shadow-sm"
/>
