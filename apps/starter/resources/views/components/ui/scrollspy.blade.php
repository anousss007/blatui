@props([
    'items' => [],
])

<nav
    data-slot="scrollspy"
    aria-label="On this page"
    x-data="{
        active: null,
        items: @js(array_values($items)),
        observer: null,
        init() {
            const targets = this.items
                .map((item) => {
                    try { return document.querySelector(item.href); }
                    catch (e) { return null; }
                })
                .filter((el) => el);

            if (!targets.length) return;

            // Default the active section to the first available target.
            this.active = targets[0].id;

            this.observer = new IntersectionObserver(
                (entries) => {
                    for (const entry of entries) {
                        if (entry.isIntersecting && entry.target.id) {
                            this.active = entry.target.id;
                        }
                    }
                },
                { rootMargin: '0px 0px -70% 0px', threshold: 0 }
            );

            targets.forEach((el) => this.observer.observe(el));
        },
        destroy() {
            if (this.observer) this.observer.disconnect();
        },
        idFor(href) {
            return (href || '').replace(/^#/, '');
        },
    }"
    {{ $attributes->twMerge('text-sm') }}
>
    <ul class="flex flex-col gap-1">
        <template x-for="item in items" :key="item.href">
            <li>
                <a
                    :href="item.href"
                    @click="active = idFor(item.href)"
                    :aria-current="active === idFor(item.href) ? 'true' : null"
                    class="block border-s-2 ps-3 py-1 outline-none transition-colors rounded-e-sm focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                    :class="[
                        active === idFor(item.href)
                            ? 'border-primary text-foreground font-medium'
                            : 'border-transparent text-muted-foreground hover:text-foreground',
                        (item.level ?? 1) >= 2 ? 'ps-4' : '',
                    ]"
                    x-text="item.label"
                ></a>
            </li>
        </template>
    </ul>
</nav>
