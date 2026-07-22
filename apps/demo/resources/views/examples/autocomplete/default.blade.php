@php($frameworks = [
    ['value' => 'next', 'label' => 'Next.js'],
    ['value' => 'svelte', 'label' => 'SvelteKit'],
    ['value' => 'nuxt', 'label' => 'Nuxt'],
    ['value' => 'remix', 'label' => 'Remix'],
    ['value' => 'astro', 'label' => 'Astro'],
    ['value' => 'laravel', 'label' => 'Laravel'],
])

<x-ui.autocomplete :options="$frameworks" placeholder="Search framework..." />
