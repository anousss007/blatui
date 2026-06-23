{{-- `trigger="input"` makes the field itself the search box — the inline autocomplete shape. --}}
@php($frameworks = [
    ['value' => 'next', 'label' => 'Next.js'],
    ['value' => 'svelte', 'label' => 'SvelteKit'],
    ['value' => 'nuxt', 'label' => 'Nuxt'],
    ['value' => 'remix', 'label' => 'Remix'],
    ['value' => 'astro', 'label' => 'Astro'],
    ['value' => 'laravel', 'label' => 'Laravel'],
])

<x-ui.combobox trigger="input" :options="$frameworks" placeholder="Search framework..." />
