<div>
    <h1 class="text-2xl font-bold">Field wiring across a morph</h1>

    <form wire:submit="save" class="mt-6">
        <x-ui.field-group>
            {{-- No description: the plain aria-invalid / data-invalid path. --}}
            <x-ui.field data-testid="field-name">
                <x-ui.field-label for="name">Name</x-ui.field-label>
                <x-ui.input id="name" wire:model="name" data-testid="control-name" />
                <x-ui.field-error :messages="$errors->get('name')" />
            </x-ui.field>

            {{-- Description present from the first render, error added later: aria-describedby
                 has to end up holding BOTH ids, without losing the one it started with. --}}
            <x-ui.field data-testid="field-email">
                <x-ui.field-label for="email">Email</x-ui.field-label>
                <x-ui.input id="email" wire:model="email" data-testid="control-email" />
                <x-ui.field-description>We only use this to sign you in.</x-ui.field-description>
                <x-ui.field-error :messages="$errors->get('email')" />
            </x-ui.field>
        </x-ui.field-group>

        <div class="mt-6 flex gap-3">
            <x-ui.button type="submit" data-testid="submit">Save</x-ui.button>
            <x-ui.button type="button" variant="outline" wire:click="clear" data-testid="clear">Make valid</x-ui.button>
        </div>
    </form>
</div>
