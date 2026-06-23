{{-- Inline-input + multiple = a tag input: picks become removable chips inside the field
     and the list stays open after each pick. --}}
<x-ui.combobox
    trigger="input"
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
