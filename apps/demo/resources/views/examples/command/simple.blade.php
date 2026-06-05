<x-ui.command class="max-w-md rounded-lg border shadow-md">
    <x-ui.command-input placeholder="Search framework..." />
    <x-ui.command-list>
        <x-ui.command-empty>No results found.</x-ui.command-empty>
        <x-ui.command-group heading="Frameworks">
            <x-ui.command-item><span>Next.js</span></x-ui.command-item>
            <x-ui.command-item><span>SvelteKit</span></x-ui.command-item>
            <x-ui.command-item><span>Nuxt</span></x-ui.command-item>
            <x-ui.command-item><span>Remix</span></x-ui.command-item>
            <x-ui.command-item><span>Astro</span></x-ui.command-item>
        </x-ui.command-group>
    </x-ui.command-list>
</x-ui.command>
