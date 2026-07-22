{{-- A settings list — each row has a switch in its actions slot. --}}
<x-ui.item-group class="w-full max-w-md rounded-lg border">
    <x-ui.item>
        <x-ui.item-media variant="icon"><x-lucide-bell-ring /></x-ui.item-media>
        <x-ui.item-content>
            <x-ui.item-title>Push notifications</x-ui.item-title>
            <x-ui.item-description>Receive push notifications on this device.</x-ui.item-description>
        </x-ui.item-content>
        <x-ui.item-actions>
            <x-ui.switch :checked="true" aria-label="Push notifications" />
        </x-ui.item-actions>
    </x-ui.item>
    <x-ui.item-separator />
    <x-ui.item>
        <x-ui.item-media variant="icon"><x-lucide-mail /></x-ui.item-media>
        <x-ui.item-content>
            <x-ui.item-title>Email updates</x-ui.item-title>
            <x-ui.item-description>Get product news and announcements.</x-ui.item-description>
        </x-ui.item-content>
        <x-ui.item-actions>
            <x-ui.switch aria-label="Email updates" />
        </x-ui.item-actions>
    </x-ui.item>
    <x-ui.item-separator />
    <x-ui.item>
        <x-ui.item-media variant="icon"><x-lucide-moon /></x-ui.item-media>
        <x-ui.item-content>
            <x-ui.item-title>Dark mode</x-ui.item-title>
            <x-ui.item-description>Use the dark theme across the app.</x-ui.item-description>
        </x-ui.item-content>
        <x-ui.item-actions>
            <x-ui.switch :checked="true" aria-label="Dark mode" />
        </x-ui.item-actions>
    </x-ui.item>
</x-ui.item-group>
