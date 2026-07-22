<div class="grid grid-cols-2 gap-2">
    @foreach (['top', 'right', 'bottom', 'left'] as $side)
        <x-ui.sheet>
            <x-ui.sheet-trigger>
                <x-ui.button variant="outline" class="w-full capitalize">{{ $side }}</x-ui.button>
            </x-ui.sheet-trigger>
            <x-ui.sheet-content :side="$side">
                <x-ui.sheet-header>
                    <x-ui.sheet-title>Edit profile</x-ui.sheet-title>
                    <x-ui.sheet-description>
                        Make changes to your profile here. Click save when you're done.
                    </x-ui.sheet-description>
                </x-ui.sheet-header>
                <x-ui.sheet-footer>
                    <x-ui.button type="submit">Save changes</x-ui.button>
                </x-ui.sheet-footer>
            </x-ui.sheet-content>
        </x-ui.sheet>
    @endforeach
</div>
