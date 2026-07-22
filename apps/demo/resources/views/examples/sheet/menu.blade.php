<x-ui.sheet>
    <x-ui.sheet-trigger>
        <x-ui.button variant="outline" size="icon" aria-label="Open menu"><x-lucide-panel-left aria-hidden="true" /></x-ui.button>
    </x-ui.sheet-trigger>
    <x-ui.sheet-content side="left">
        <x-ui.sheet-header>
            <x-ui.sheet-title>Menu</x-ui.sheet-title>
            <x-ui.sheet-description>Navigate your workspace.</x-ui.sheet-description>
        </x-ui.sheet-header>
        <nav class="grid gap-1 px-4">
            <a href="#" class="hover:bg-accent flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium"><x-lucide-house class="size-4" aria-hidden="true" /> Home</a>
            <a href="#" class="hover:bg-accent flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium"><x-lucide-inbox class="size-4" aria-hidden="true" /> Inbox</a>
            <a href="#" class="hover:bg-accent flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium"><x-lucide-calendar class="size-4" aria-hidden="true" /> Calendar</a>
            <a href="#" class="hover:bg-accent flex items-center gap-2 rounded-md px-2 py-2 text-sm font-medium"><x-lucide-settings class="size-4" aria-hidden="true" /> Settings</a>
        </nav>
    </x-ui.sheet-content>
</x-ui.sheet>
