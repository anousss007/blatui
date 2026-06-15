{{--
    A scrollable box that loads more items as you scroll. The component dispatches a
    'load-more' event when its sentinel nears the bottom; this demo listens for it and
    appends 5 more items from a JS array (with a short simulated delay so the spinner +
    aria-busy are visible), capping at 30 so the "end" state shows. The Load more button
    triggers the exact same path, so keyboard / no-JS users are covered too.

    Real apps replace the demo's setTimeout with a Livewire call or fetch():
        @load-more="fetch('/items?page=' + page)
            .then(r => r.json())
            .then(rows => { items.push(...rows.data); page++;
                $event.target.dispatchEvent(new CustomEvent('load-more-done',
                    { detail: { done: !rows.hasMore } })); })"
--}}
<div
    x-data="{
        items: Array.from({ length: 10 }, (_, i) => i + 1),
        max: 30,
        loadDemo(e) {
            // Simulate a network round-trip so the loading state is visible.
            setTimeout(() => {
                const start = this.items.length;
                const add = Math.min(5, this.max - start);
                for (let i = 1; i <= add; i++) this.items.push(start + i);
                const done = this.items.length >= this.max;
                e.target.dispatchEvent(new CustomEvent('load-more-done', { detail: { done } }));
            }, 600);
        },
    }"
    class="w-full max-w-md"
>
    <div class="h-72 overflow-y-auto rounded-lg border bg-card p-3">
        <x-ui.infinite-scroll :threshold="120" x-on:load-more="loadDemo($event)">
            <template x-for="n in items" :key="n">
                <div class="flex items-center gap-3 rounded-md border bg-background px-3 py-2.5 text-sm">
                    <span class="flex size-7 shrink-0 items-center justify-center rounded-full bg-muted text-xs font-medium text-muted-foreground" x-text="n"></span>
                    <span class="text-foreground">Item <span x-text="n"></span></span>
                </div>
            </template>
        </x-ui.infinite-scroll>
    </div>
</div>
