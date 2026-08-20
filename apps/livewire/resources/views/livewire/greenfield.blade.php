<div>
    <h1 class="text-2xl font-bold">Published bootstrap + Livewire</h1>

    <form wire:submit="save" class="mt-6">
        <x-ui.field data-testid="field-name">
            <x-ui.field-label for="gf-name">Name</x-ui.field-label>
            <x-ui.input id="gf-name" wire:model="name" data-testid="control-name" />
            <x-ui.field-error :messages="$errors->get('name')" />
        </x-ui.field>

        <div class="mt-4 flex items-center gap-4">
            <x-ui.switch wire:model.live="notify" data-testid="switch" />
            <span class="text-sm">notify: <span data-testid="notify">{{ $notify ? 'on' : 'off' }}</span></span>
        </div>

        <x-ui.button type="submit" class="mt-4" data-testid="submit">Save</x-ui.button>
    </form>

    {{-- A teleporting popover: needs Alpine plugins, and needs them on the SAME Alpine that
         walked this tree. Two instances and this is where it shows. --}}
    <x-ui.dropdown-menu class="mt-6">
        <x-ui.dropdown-menu-trigger>
            <x-ui.button variant="outline" data-testid="menu">Open menu</x-ui.button>
        </x-ui.dropdown-menu-trigger>
        <x-ui.dropdown-menu-content>
            <x-ui.dropdown-menu-item>First</x-ui.dropdown-menu-item>
            <x-ui.dropdown-menu-item>Second</x-ui.dropdown-menu-item>
        </x-ui.dropdown-menu-content>
    </x-ui.dropdown-menu>
</div>
