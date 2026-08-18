<div>
    <h1 class="text-2xl font-bold">Popover whose trigger is morphed away</h1>

    {{-- Goes through the server, so the subtree below is morphed before the dialog is shown. --}}
    <x-ui.button wire:click="open" class="mt-6" data-testid="open">Open</x-ui.button>
    <p class="text-muted-foreground mt-2 text-sm">renders: <span data-testid="renders">{{ $renders }}</span></p>

    <x-ui.dialog id="picker" class="contents">
        <x-ui.dialog-content>
            <x-ui.dialog-header>
                <x-ui.dialog-title>Pick branches</x-ui.dialog-title>
            </x-ui.dialog-header>

            <x-ui.field>
                <x-ui.field-label>Branches</x-ui.field-label>
                <x-ui.combobox
                    wire:model="branches"
                    :options="$branchOptions"
                    multiple
                    indicator="checkbox"
                    width="w-full"
                    placeholder="Select branches"
                    data-testid="combobox"
                />
            </x-ui.field>
        </x-ui.dialog-content>
    </x-ui.dialog>
</div>
