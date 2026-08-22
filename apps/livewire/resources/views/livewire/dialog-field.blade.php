<div>
    <h1 class="text-2xl font-bold">Field wiring inside a dialog</h1>

    <x-ui.button x-data @click="$dispatch('open-dialog-demo')" class="mt-6" data-testid="open">Open</x-ui.button>

    <x-ui.dialog id="demo" class="contents">
        <x-ui.dialog-content>
            <x-ui.dialog-header>
                <x-ui.dialog-title>Add a person</x-ui.dialog-title>
            </x-ui.dialog-header>

            <form wire:submit="save">
                <x-ui.field data-testid="field-name">
                    <x-ui.field-label for="dlg-name">Name</x-ui.field-label>
                    <x-ui.input id="dlg-name" wire:model="name" data-testid="control-name" />
                    <x-ui.field-error :messages="$errors->get('name')" />
                </x-ui.field>

                {{-- Bound from inside the dialog: Alpine teleports this content to <body>, so the
                     control has no wire:id ancestor in the DOM at all (#25). --}}
                <div data-testid="choice" class="mt-4">
                    <x-ui.select wire:model.live="choice" :options="['a' => 'Alfa', 'b' => 'Beta', 'c' => 'Gamma']" />
                </div>

                <x-ui.button type="submit" class="mt-4" data-testid="submit">Save</x-ui.button>
            </form>
        </x-ui.dialog-content>
    </x-ui.dialog>
</div>
