{{-- Hide the pointer with the `arrow` prop. --}}
<x-ui.tooltip>
    <x-ui.tooltip-trigger>
        <x-ui.button variant="outline">Hover</x-ui.button>
    </x-ui.tooltip-trigger>
    <x-ui.tooltip-content :arrow="false">
        No arrow tooltip
    </x-ui.tooltip-content>
</x-ui.tooltip>
