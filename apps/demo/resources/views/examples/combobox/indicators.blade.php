{{-- Choose how a selected option is marked: `check` (default), `checkbox`
     (pairs well with multiple) or `radio` (pairs well with single-select). --}}
<div class="flex flex-wrap items-start gap-4">
    <x-ui.combobox
        indicator="checkbox"
        multiple
        width="w-[220px]"
        placeholder="Select frameworks..."
        :value="['next']"
        :options="[
            ['value' => 'next', 'label' => 'Next.js'],
            ['value' => 'nuxt', 'label' => 'Nuxt.js'],
            ['value' => 'remix', 'label' => 'Remix'],
            ['value' => 'astro', 'label' => 'Astro'],
        ]"
    />

    <x-ui.combobox
        indicator="radio"
        width="w-[220px]"
        placeholder="Select a framework..."
        :value="'next'"
        :options="[
            ['value' => 'next', 'label' => 'Next.js'],
            ['value' => 'nuxt', 'label' => 'Nuxt.js'],
            ['value' => 'remix', 'label' => 'Remix'],
            ['value' => 'astro', 'label' => 'Astro'],
        ]"
    />
</div>
