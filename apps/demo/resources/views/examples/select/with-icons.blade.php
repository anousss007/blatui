<x-ui.select>
    <x-ui.select-trigger class="w-[180px]" aria-label="Status">
        <x-ui.select-value placeholder="Status" />
    </x-ui.select-trigger>
    <x-ui.select-content>
        <x-ui.select-item value="online"><x-lucide-circle-check aria-hidden="true" /> Online</x-ui.select-item>
        <x-ui.select-item value="away"><x-lucide-clock aria-hidden="true" /> Away</x-ui.select-item>
        <x-ui.select-item value="busy"><x-lucide-minus-circle aria-hidden="true" /> Busy</x-ui.select-item>
        <x-ui.select-item value="offline"><x-lucide-circle aria-hidden="true" /> Offline</x-ui.select-item>
    </x-ui.select-content>
</x-ui.select>
