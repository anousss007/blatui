<div>
    <h1 class="text-2xl font-bold">Client-side wiring a morph walks over</h1>

    {{-- Nothing about the field changes; the re-render is caused by an unrelated property. --}}
    <x-ui.button wire:click="tick" class="mt-6" data-testid="tick">Re-render</x-ui.button>
    <p class="text-muted-foreground mt-2 text-sm">ticks: <span data-testid="ticks">{{ $ticks }}</span></p>

    {{-- No `for` and no `id`: both are wired by x-blat-field at runtime, so both are exactly
         what the morph has no server-side counterpart for. --}}
    <x-ui.field class="mt-6" data-testid="field-auto">
        <x-ui.field-label>Nickname</x-ui.field-label>
        <x-ui.input wire:model="nickname" data-testid="control-auto" />
        <x-ui.field-description>Shown next to your comments.</x-ui.field-description>
    </x-ui.field>
</div>
