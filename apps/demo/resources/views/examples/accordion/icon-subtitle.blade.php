{{-- Circular icon badge with a title and subtitle, plus / minus toggle. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center">
            <span class="flex items-center gap-3">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-full border" aria-hidden="true"><x-lucide-truck class="size-4" /></span>
                <span class="flex flex-col">
                    <span>How do I track my order?</span>
                    <span class="text-muted-foreground text-xs font-normal">Shipping &amp; delivery</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-13">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center">
            <span class="flex items-center gap-3">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-full border" aria-hidden="true"><x-lucide-undo-2 class="size-4" /></span>
                <span class="flex flex-col">
                    <span>What is your return policy?</span>
                    <span class="text-muted-foreground text-xs font-normal">Returns &amp; refunds</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-13">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center">
            <span class="flex items-center gap-3">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-full border" aria-hidden="true"><x-lucide-globe class="size-4" /></span>
                <span class="flex flex-col">
                    <span>Do you ship internationally?</span>
                    <span class="text-muted-foreground text-xs font-normal">Worldwide shipping</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-13">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
