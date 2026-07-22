<x-ui.command-dialog>
    <x-slot:trigger>
        <x-ui.button variant="outline" class="text-muted-foreground w-64 justify-between font-normal">
            <span class="inline-flex items-center gap-2"><x-lucide-search aria-hidden="true" /> Search…</span>
            <span class="text-xs">⌘J</span>
        </x-ui.button>
    </x-slot:trigger>

    <x-ui.command class="rounded-lg">
        <x-ui.command-input placeholder="Type a command or search..." />
        <x-ui.command-list>
            <x-ui.command-empty>No results found.</x-ui.command-empty>
            <x-ui.command-group heading="Suggestions">
                <x-ui.command-item><x-lucide-calendar /><span>Calendar</span></x-ui.command-item>
                <x-ui.command-item><x-lucide-smile /><span>Search Emoji</span></x-ui.command-item>
                <x-ui.command-item><x-lucide-calculator /><span>Calculator</span></x-ui.command-item>
            </x-ui.command-group>
            <x-ui.command-separator />
            <x-ui.command-group heading="Settings">
                <x-ui.command-item><x-lucide-user /><span>Profile</span><x-ui.command-shortcut>⌘P</x-ui.command-shortcut></x-ui.command-item>
                <x-ui.command-item><x-lucide-settings /><span>Settings</span><x-ui.command-shortcut>⌘S</x-ui.command-shortcut></x-ui.command-item>
            </x-ui.command-group>
        </x-ui.command-list>
    </x-ui.command>
</x-ui.command-dialog>
