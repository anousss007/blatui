{{-- Selectable command with trailing check marks and a disabled item. --}}
<x-ui.command class="max-w-md rounded-lg border shadow-md">
    <x-ui.command-input placeholder="Select frameworks..." />
    <x-ui.command-list>
        <x-ui.command-empty>No results found.</x-ui.command-empty>
        <x-ui.command-group heading="Frameworks">
            <x-ui.command-item>
                <span>Next.js</span>
                <x-lucide-check class="text-primary ml-auto" aria-hidden="true" />
            </x-ui.command-item>
            <x-ui.command-item>
                <span>SvelteKit</span>
            </x-ui.command-item>
            <x-ui.command-item>
                <span>Nuxt</span>
                <x-lucide-check class="text-primary ml-auto" aria-hidden="true" />
            </x-ui.command-item>
            <x-ui.command-item>
                <span>Remix</span>
            </x-ui.command-item>
            <x-ui.command-item disabled>
                <span>Astro</span>
                <span class="text-muted-foreground ml-auto text-xs">Soon</span>
            </x-ui.command-item>
        </x-ui.command-group>
    </x-ui.command-list>
</x-ui.command>
