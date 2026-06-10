<x-ui.combobox
    multiple
    width="w-[260px]"
    placeholder="Select frameworks..."
    searchPlaceholder="Search framework..."
    empty="No framework found."
    :value="['next', 'remix']"
    :options="[
        ['value' => 'next', 'label' => 'Next.js'],
        ['value' => 'sveltekit', 'label' => 'SvelteKit'],
        ['value' => 'nuxt', 'label' => 'Nuxt.js'],
        ['value' => 'remix', 'label' => 'Remix'],
        ['value' => 'astro', 'label' => 'Astro'],
    ]"
/>
