@php($frameworks = [
    ['value' => 'next', 'label' => 'Next.js'],
    ['value' => 'svelte', 'label' => 'SvelteKit'],
    ['value' => 'nuxt', 'label' => 'Nuxt'],
])

<x-ui.autocomplete :options="$frameworks" disabled placeholder="Search framework..." />
