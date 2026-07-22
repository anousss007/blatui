{{-- Checked-state colours via the semantic tokens. --}}
<x-ui.radio-group value="success" class="flex flex-wrap items-center gap-5">
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="success" id="c-success" class="text-success data-[state=checked]:border-success" />
        <x-ui.label for="c-success">Success</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="info" id="c-info" class="text-info data-[state=checked]:border-info" />
        <x-ui.label for="c-info">Info</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="warning" id="c-warning" class="text-warning data-[state=checked]:border-warning" />
        <x-ui.label for="c-warning">Warning</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="danger" id="c-danger" class="text-destructive data-[state=checked]:border-destructive" />
        <x-ui.label for="c-danger">Danger</x-ui.label>
    </div>
</x-ui.radio-group>
