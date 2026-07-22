{{--
    Async options: the inline-input combobox is just a listbox over its reactive `options`,
    so you can swap that array in from a server as the user types. This demo debounces the
    query, fakes a fetch against a static dataset, then assigns the result onto the
    component's `options` via Alpine.$data(). Swap `fetchOptions` for a real
    `fetch('/api/...').then(r => r.json())`.
--}}
<div
    x-data="{
        loading: false,
        _t: null,
        all: [
            { value: 'next', label: 'Next.js' },
            { value: 'svelte', label: 'SvelteKit' },
            { value: 'nuxt', label: 'Nuxt' },
            { value: 'remix', label: 'Remix' },
            { value: 'astro', label: 'Astro' },
            { value: 'laravel', label: 'Laravel' },
            { value: 'rails', label: 'Ruby on Rails' },
            { value: 'django', label: 'Django' },
        ],
        fetchOptions(q) {
            // Pretend this is a network round-trip.
            const needle = q.toLowerCase();
            return new Promise((resolve) =>
                setTimeout(() => resolve(this.all.filter((o) => o.label.toLowerCase().includes(needle))), 350),
            );
        },
        // The native `input` event bubbles from the field; read the combobox's reactive
        // state with Alpine.$data and replace its `options` after the fetch settles.
        onSearch(e) {
            const cmp = Alpine.$data(e.target.closest('[data-slot=combobox]'));
            clearTimeout(this._t);
            this.loading = true;
            this._t = setTimeout(async () => {
                cmp.options = await this.fetchOptions(cmp.query);
                this.loading = false;
            }, 250);
        },
    }"
    class="w-[280px]"
    @input="onSearch($event)"
    ::class="loading && 'opacity-70'"
>
    <x-ui.combobox trigger="input" width="w-full" placeholder="Search frameworks (async)..." />
</div>
