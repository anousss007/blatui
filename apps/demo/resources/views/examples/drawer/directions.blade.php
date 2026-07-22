<div class="flex flex-wrap items-center gap-2">
    @foreach (['top', 'right', 'bottom', 'left'] as $dir)
        <x-ui.drawer direction="{{ $dir }}">
            <x-ui.drawer-trigger>
                <x-ui.button variant="outline">{{ ucfirst($dir) }}</x-ui.button>
            </x-ui.drawer-trigger>
            <x-ui.drawer-content>
                <div class="mx-auto w-full max-w-sm">
                    <x-ui.drawer-header>
                        <x-ui.drawer-title>{{ ucfirst($dir) }} drawer</x-ui.drawer-title>
                        <x-ui.drawer-description>This drawer slides in from the {{ $dir }} edge of the screen.</x-ui.drawer-description>
                    </x-ui.drawer-header>
                    <x-ui.drawer-footer>
                        <x-ui.drawer-close>
                            <x-ui.button variant="outline" class="w-full">Close</x-ui.button>
                        </x-ui.drawer-close>
                    </x-ui.drawer-footer>
                </div>
            </x-ui.drawer-content>
        </x-ui.drawer>
    @endforeach
</div>
