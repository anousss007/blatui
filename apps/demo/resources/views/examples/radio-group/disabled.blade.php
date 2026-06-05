<x-ui.radio-group value="comfortable">
    <div class="flex items-center gap-3">
        <x-ui.radio-group-item value="default" id="rd1" />
        <x-ui.label for="rd1">Default</x-ui.label>
    </div>
    <div class="flex items-center gap-3">
        <x-ui.radio-group-item value="comfortable" id="rd2" />
        <x-ui.label for="rd2">Comfortable</x-ui.label>
    </div>
    <div class="flex items-center gap-3">
        <x-ui.radio-group-item value="compact" id="rd3" disabled />
        <x-ui.label for="rd3">Compact (unavailable)</x-ui.label>
    </div>
</x-ui.radio-group>
