<x-ui.command class="max-w-md rounded-lg border shadow-md">
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
