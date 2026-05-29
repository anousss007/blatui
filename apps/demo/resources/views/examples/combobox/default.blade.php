<x-ui.combobox
    placeholder="Select framework..."
    searchPlaceholder="Search framework..."
    empty="No framework found."
    :options="[
        ['value' => 'next', 'label' => 'Next.js'],
        ['value' => 'sveltekit', 'label' => 'SvelteKit'],
        ['value' => 'nuxt', 'label' => 'Nuxt.js'],
        ['value' => 'remix', 'label' => 'Remix'],
        ['value' => 'astro', 'label' => 'Astro'],
    ]"
/>
