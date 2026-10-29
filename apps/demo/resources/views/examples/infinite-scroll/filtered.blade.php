{{--
    A filter applied in the browser over what is loaded. Only one row in six is "Rare", so with
    that filter a batch adds a row or two and the end of the list stays in view. After each
    batch the component checks again and asks for the next one, until the box is full or the
    data runs out, instead of stopping at the Load more button (a scroll that cannot happen).

    With Livewire, `more()` is a #[Renderless] method that returns the rows for an offset:
        x-on:load-more="$wire.more(rows.length).then((page) => {
            rows.push(...page.rows); page.hasMore ? $event.detail.loaded() : $event.detail.done();
        })"
--}}
<div
    x-data="{
        rows: [],
        filter: 'all',
        total: 120,
        get shown() { return this.filter === 'all' ? this.rows : this.rows.filter((r) => r.kind === this.filter); },
        more(e) {
            setTimeout(() => {
                const start = this.rows.length;
                for (let i = start + 1; i <= Math.min(start + 12, this.total); i++) {
                    this.rows.push({ id: i, kind: i % 6 === 0 ? 'rare' : 'common' });
                }
                this.rows.length >= this.total ? e.detail.done() : e.detail.loaded();
            }, 150);
        },
    }"
    class="w-full max-w-md space-y-3"
>
    <div class="flex gap-2" role="group" aria-label="Filter">
        <x-ui.button size="sm" variant="outline" class="aria-pressed:bg-accent" x-bind:aria-pressed="filter === 'all'" x-on:click="filter = 'all'">All</x-ui.button>
        <x-ui.button size="sm" variant="outline" class="aria-pressed:bg-accent" x-bind:aria-pressed="filter === 'rare'" x-on:click="filter = 'rare'">Rare</x-ui.button>
    </div>
    <div class="h-72 overflow-y-auto rounded-lg border bg-card p-3">
        <x-ui.infinite-scroll :threshold="120" x-on:load-more="more($event)">
            <template x-for="row in shown" :key="row.id">
                <div data-row class="flex items-center justify-between rounded-md border bg-background px-3 py-2.5 text-sm">
                    <span>Item <span x-text="row.id"></span></span>
                    <x-ui.badge variant="secondary" x-text="row.kind"></x-ui.badge>
                </div>
            </template>
        </x-ui.infinite-scroll>
    </div>
</div>
