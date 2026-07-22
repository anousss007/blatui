{{-- Mix named keys with fully custom entries. Named keys resolve client-side
     relative to today; custom entries pass literal 'Y-m-d' ranges or dates. --}}
<x-ui.date-picker
    mode="range"
    name="fiscal"
    :presets="[
        'last7Days',
        'last30Days',
        'thisMonth',
        'yearToDate',
        'Q1 2026' => ['from' => '2026-01-01', 'to' => '2026-03-31'],
    ]"
/>
