{{-- A single bordered, rounded container wrapping all items. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md overflow-hidden rounded-lg border">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="chevron-updown" class="px-5">How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="chevron-updown" class="px-5">What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="chevron-updown" class="px-5">Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
