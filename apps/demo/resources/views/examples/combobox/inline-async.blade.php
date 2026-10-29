{{--
    Async options: with `remote`, the combobox asks for its options with a `combobox-fetch`
    event while you type (debounced), and asks for the next page when the list is scrolled to
    its end. Answer with `respond()`: an array, `{ options, hasMore }`, or a promise of either.
    The browser does not filter what the server returned. With Livewire the handler is one line:
    `$event.detail.respond($wire.search($event.detail.query, $event.detail.offset, $event.detail.limit))`.
    Here a fake 350 ms fetch pages through 200 generated frameworks.
--}}
<div
    x-data="{
        all: Array.from({ length: 200 }, (_, i) => ({ value: 'fw-' + (i + 1), label: 'Framework ' + String(i + 1).padStart(3, '0') })),
        search({ query, offset, limit }) {
            const needle = query.toLowerCase();
            const matches = this.all.filter((o) => o.label.toLowerCase().includes(needle));
            return new Promise((resolve) => setTimeout(() => resolve({
                options: matches.slice(offset, offset + limit),
                hasMore: offset + limit < matches.length,
            }), 350));
        },
    }"
    class="w-[280px]"
>
    <x-ui.combobox
        trigger="input"
        remote
        :page-size="20"
        width="w-full"
        placeholder="Search frameworks (async)..."
        x-on:combobox-fetch="$event.detail.respond(search($event.detail))"
    />
</div>
