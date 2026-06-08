<x-ui.card variant="sectioned" class="w-full max-w-sm overflow-hidden pt-0">
    <img src="https://images.unsplash.com/photo-1577140917170-285929fb55b7?w=800&q=80&auto=format&fit=crop"
        alt="Solid oak dining table with wooden chairs"
        class="aspect-[4/3] w-full object-cover" />
    <x-ui.card-header>
        <div class="flex items-start justify-between gap-2">
            <x-ui.card-title>Classic Wooden Table</x-ui.card-title>
            <x-ui.badge variant="secondary">In stock</x-ui.badge>
        </div>
        <x-ui.card-description>Solid oak dining table that seats six.</x-ui.card-description>
    </x-ui.card-header>
    <x-ui.card-content>
        <div class="flex items-center gap-1.5 text-sm">
            <span class="flex text-amber-500" aria-hidden="true">
                <x-lucide-star class="size-4 fill-current" />
                <x-lucide-star class="size-4 fill-current" />
                <x-lucide-star class="size-4 fill-current" />
                <x-lucide-star class="size-4 fill-current" />
                <x-lucide-star-half class="size-4 fill-current" />
            </span>
            <span class="text-muted-foreground">4.6 (128 reviews)</span>
        </div>
    </x-ui.card-content>
    <x-ui.card-footer class="justify-between">
        <span class="text-2xl font-semibold tabular-nums">$249</span>
        <x-ui.button><x-lucide-shopping-cart aria-hidden="true" /> Add to cart</x-ui.button>
    </x-ui.card-footer>
</x-ui.card>
