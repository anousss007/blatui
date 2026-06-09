{{-- A text segmented control — single select across a date range. --}}
<x-ui.toggle-group type="single" variant="outline" value="30d">
    <x-ui.toggle-group-item value="today" class="px-3">Today</x-ui.toggle-group-item>
    <x-ui.toggle-group-item value="7d" class="px-3">7D</x-ui.toggle-group-item>
    <x-ui.toggle-group-item value="30d" class="px-3">30D</x-ui.toggle-group-item>
    <x-ui.toggle-group-item value="3m" class="px-3">3M</x-ui.toggle-group-item>
    <x-ui.toggle-group-item value="6m" class="px-3">6M</x-ui.toggle-group-item>
</x-ui.toggle-group>
