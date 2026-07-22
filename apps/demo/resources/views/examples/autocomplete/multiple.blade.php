<x-ui.autocomplete
    multiple
    width="w-[280px]"
    placeholder="Search frameworks..."
    :value="['next']"
    :options="[
        ['value' => 'next', 'label' => 'Next.js'],
        ['value' => 'svelte', 'label' => 'SvelteKit'],
        ['value' => 'nuxt', 'label' => 'Nuxt'],
        ['value' => 'remix', 'label' => 'Remix'],
        ['value' => 'astro', 'label' => 'Astro'],
    ]"
/>
