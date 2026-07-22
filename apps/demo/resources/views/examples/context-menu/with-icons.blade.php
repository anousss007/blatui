<x-ui.context-menu>
    <x-ui.context-menu-trigger class="border-input flex h-[150px] w-[300px] items-center justify-center rounded-md border border-dashed text-sm">
        Right click here
    </x-ui.context-menu-trigger>
    <x-ui.context-menu-content class="w-52">
        <x-ui.context-menu-item><x-lucide-copy aria-hidden="true" /> Copy <x-ui.context-menu-shortcut>⌘C</x-ui.context-menu-shortcut></x-ui.context-menu-item>
        <x-ui.context-menu-item><x-lucide-scissors aria-hidden="true" /> Cut <x-ui.context-menu-shortcut>⌘X</x-ui.context-menu-shortcut></x-ui.context-menu-item>
        <x-ui.context-menu-item><x-lucide-clipboard aria-hidden="true" /> Paste <x-ui.context-menu-shortcut>⌘V</x-ui.context-menu-shortcut></x-ui.context-menu-item>
        <x-ui.context-menu-separator />
        <x-ui.context-menu-item variant="destructive"><x-lucide-trash-2 aria-hidden="true" /> Delete</x-ui.context-menu-item>
    </x-ui.context-menu-content>
</x-ui.context-menu>
