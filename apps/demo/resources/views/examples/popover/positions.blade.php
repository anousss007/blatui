{{-- The `side` prop places the popover on any edge of the trigger. --}}
<div class="flex flex-wrap items-center justify-center gap-2">
    @foreach (['top', 'right', 'bottom', 'left'] as $side)
        <x-ui.popover>
            <x-ui.popover-trigger>
                <x-ui.button variant="outline" class="capitalize">{{ $side }}</x-ui.button>
            </x-ui.popover-trigger>
            <x-ui.popover-content side="{{ $side }}" class="w-auto">
                <p class="text-sm">Popover on the <span class="font-medium">{{ $side }}</span>.</p>
            </x-ui.popover-content>
        </x-ui.popover>
    @endforeach
</div>
