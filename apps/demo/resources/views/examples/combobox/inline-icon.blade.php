{{-- The inline-input trigger accepts a leading `icon` (any lucide name) and a `size`. --}}
@php($frameworks = [
    ['value' => 'next', 'label' => 'Next.js'],
    ['value' => 'svelte', 'label' => 'SvelteKit'],
    ['value' => 'nuxt', 'label' => 'Nuxt'],
    ['value' => 'remix', 'label' => 'Remix'],
    ['value' => 'astro', 'label' => 'Astro'],
    ['value' => 'laravel', 'label' => 'Laravel'],
])

<x-ui.combobox trigger="input" icon="search" :options="$frameworks" placeholder="Search framework..." />
