@php($frameworks = [
    ['value' => 'next', 'label' => 'Next.js'],
    ['value' => 'svelte', 'label' => 'SvelteKit'],
    ['value' => 'nuxt', 'label' => 'Nuxt'],
    ['value' => 'remix', 'label' => 'Remix'],
    ['value' => 'astro', 'label' => 'Astro'],
])

<div class="flex flex-col gap-3">
    <x-ui.autocomplete :options="$frameworks" size="sm" placeholder="Small" />
    <x-ui.autocomplete :options="$frameworks" size="default" placeholder="Default" />
    <x-ui.autocomplete :options="$frameworks" size="lg" placeholder="Large" />
</div>
