{{-- Checked-state colours via class overrides on the semantic tokens. --}}
<div class="flex flex-wrap items-center gap-5">
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-success" checked class="data-[state=checked]:bg-success data-[state=checked]:border-success dark:data-[state=checked]:bg-success" />
        <x-ui.label for="cb-success">Success</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-info" checked class="data-[state=checked]:bg-info data-[state=checked]:border-info dark:data-[state=checked]:bg-info" />
        <x-ui.label for="cb-info">Info</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-warning" checked class="data-[state=checked]:bg-warning data-[state=checked]:border-warning dark:data-[state=checked]:bg-warning" />
        <x-ui.label for="cb-warning">Warning</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-danger" checked class="data-[state=checked]:bg-destructive data-[state=checked]:border-destructive dark:data-[state=checked]:bg-destructive" />
        <x-ui.label for="cb-danger">Danger</x-ui.label>
    </div>
</div>
