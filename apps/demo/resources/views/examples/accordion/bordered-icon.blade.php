{{-- Bordered container with a leading icon and subtitle on every row. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md overflow-hidden rounded-lg border">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center px-5">
            <span class="flex items-center gap-3">
                <x-lucide-truck class="text-muted-foreground size-4 shrink-0" />
                <span class="flex flex-col">
                    <span>How do I track my order?</span>
                    <span class="text-muted-foreground text-xs font-normal">Shipping &amp; delivery</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-12">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center px-5">
            <span class="flex items-center gap-3">
                <x-lucide-undo-2 class="text-muted-foreground size-4 shrink-0" />
                <span class="flex flex-col">
                    <span>What is your return policy?</span>
                    <span class="text-muted-foreground text-xs font-normal">Returns &amp; refunds</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-12">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center px-5">
            <span class="flex items-center gap-3">
                <x-lucide-globe class="text-muted-foreground size-4 shrink-0" />
                <span class="flex flex-col">
                    <span>Do you ship internationally?</span>
                    <span class="text-muted-foreground text-xs font-normal">Worldwide shipping</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-12">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
