<x-ui.select
    multiple
    name="frameworks"
    placeholder="Select frameworks..."
    class="w-[260px]"
    :value="['next', 'remix']"
    :options="[
        'next' => 'Next.js',
        'sveltekit' => 'SvelteKit',
        'nuxt' => 'Nuxt.js',
        'remix' => 'Remix',
        'astro' => 'Astro',
    ]"
/>
