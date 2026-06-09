{{-- Multi-line content with a title and a keyboard hint. --}}
<x-ui.tooltip>
    <x-ui.tooltip-trigger>
        <x-ui.button variant="outline">Hover for details</x-ui.button>
    </x-ui.tooltip-trigger>
    <x-ui.tooltip-content class="max-w-xs px-3 py-2">
        <p class="font-medium">Keyboard shortcut</p>
        <p class="text-primary-foreground/80 mt-1">Press <x-ui.kbd class="bg-primary-foreground/15 text-primary-foreground border-0">⌘</x-ui.kbd> <x-ui.kbd class="bg-primary-foreground/15 text-primary-foreground border-0">K</x-ui.kbd> to open the command menu.</p>
    </x-ui.tooltip-content>
</x-ui.tooltip>
