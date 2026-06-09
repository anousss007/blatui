@php($frameworks = [
    ['value' => 'next', 'label' => 'Next.js'],
    ['value' => 'svelte', 'label' => 'SvelteKit'],
    ['value' => 'nuxt', 'label' => 'Nuxt'],
    ['value' => 'remix', 'label' => 'Remix'],
    ['value' => 'astro', 'label' => 'Astro'],
])

<div class="grid w-[260px] gap-2">
    <x-ui.label for="framework">Framework</x-ui.label>
    <x-ui.autocomplete name="framework" :options="$frameworks" placeholder="Search framework..." />
</div>
