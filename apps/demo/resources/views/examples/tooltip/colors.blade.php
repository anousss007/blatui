{{-- Recolour the tooltip — the arrow inherits the background, so it always matches. --}}
<div class="flex items-center gap-3">
    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.button variant="outline">Light</x-ui.button>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content class="bg-popover text-popover-foreground border shadow-md">
            Light tooltip
        </x-ui.tooltip-content>
    </x-ui.tooltip>

    <x-ui.tooltip>
        <x-ui.tooltip-trigger>
            <x-ui.button variant="outline">Error</x-ui.button>
        </x-ui.tooltip-trigger>
        <x-ui.tooltip-content class="bg-destructive text-white">
            Something went wrong
        </x-ui.tooltip-content>
    </x-ui.tooltip>
</div>
