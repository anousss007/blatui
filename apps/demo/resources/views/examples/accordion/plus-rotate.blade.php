{{-- Leading icon with a plus that rotates into a cross when open. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="plus" class="items-center">
            <span class="flex items-center gap-3"><x-lucide-truck class="text-muted-foreground size-4 shrink-0" /> How do I track my order?</span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-7">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="plus" class="items-center">
            <span class="flex items-center gap-3"><x-lucide-undo-2 class="text-muted-foreground size-4 shrink-0" /> What is your return policy?</span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-7">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="plus" class="items-center">
            <span class="flex items-center gap-3"><x-lucide-globe class="text-muted-foreground size-4 shrink-0" /> Do you ship internationally?</span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-7">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
