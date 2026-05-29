<x-ui.command-dialog>
    <x-slot:trigger>
        <p class="text-muted-foreground text-sm">
            Press
            <kbd class="bg-muted text-muted-foreground pointer-events-none inline-flex h-5 items-center gap-1 rounded border px-1.5 font-mono text-[10px] font-medium select-none">
                <span class="text-xs">⌘</span>J
            </kbd>
        </p>
    </x-slot:trigger>

    <x-ui.command class="rounded-lg">
        <x-ui.command-input placeholder="Type a command or search..." />
        <x-ui.command-list>
            <x-ui.command-empty>No results found.</x-ui.command-empty>
            <x-ui.command-group heading="Suggestions">
                <x-ui.command-item>
                    <x-lucide-calendar />
                    <span>Calendar</span>
                </x-ui.command-item>
                <x-ui.command-item>
                    <x-lucide-smile />
                    <span>Search Emoji</span>
                </x-ui.command-item>
                <x-ui.command-item>
                    <x-lucide-calculator />
                    <span>Calculator</span>
                </x-ui.command-item>
            </x-ui.command-group>
            <x-ui.command-separator />
            <x-ui.command-group heading="Settings">
                <x-ui.command-item>
                    <x-lucide-user />
                    <span>Profile</span>
                    <x-ui.command-shortcut>⌘P</x-ui.command-shortcut>
                </x-ui.command-item>
                <x-ui.command-item>
                    <x-lucide-credit-card />
                    <span>Billing</span>
                    <x-ui.command-shortcut>⌘B</x-ui.command-shortcut>
                </x-ui.command-item>
                <x-ui.command-item>
                    <x-lucide-settings />
                    <span>Settings</span>
                    <x-ui.command-shortcut>⌘S</x-ui.command-shortcut>
                </x-ui.command-item>
            </x-ui.command-group>
        </x-ui.command-list>
    </x-ui.command>
</x-ui.command-dialog>
