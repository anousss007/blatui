{{-- Dialogs anchored to different edges/corners via the `position` prop. --}}
<div class="flex flex-wrap items-center gap-2">
    @foreach (['top-left' => 'Top left', 'top' => 'Top', 'top-right' => 'Top right', 'center' => 'Center', 'bottom-left' => 'Bottom left', 'bottom' => 'Bottom', 'bottom-right' => 'Bottom right'] as $pos => $label)
        <x-ui.dialog>
            <x-ui.dialog-trigger>
                <x-ui.button variant="outline" size="sm">{{ $label }}</x-ui.button>
            </x-ui.dialog-trigger>
            <x-ui.dialog-content position="{{ $pos }}" class="sm:max-w-sm">
                <x-ui.dialog-header>
                    <x-ui.dialog-title>{{ $label }}</x-ui.dialog-title>
                    <x-ui.dialog-description>This dialog is anchored to the <strong>{{ $label }}</strong> of the screen.</x-ui.dialog-description>
                </x-ui.dialog-header>
                <x-ui.dialog-footer>
                    <x-ui.button @click="open = false">Got it</x-ui.button>
                </x-ui.dialog-footer>
            </x-ui.dialog-content>
        </x-ui.dialog>
    @endforeach
</div>
