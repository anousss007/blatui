{{-- Expand chevron moved to the left of the label. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="chevron-updown" icon-position="left" class="justify-start">How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-7">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="chevron-updown" icon-position="left" class="justify-start">What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-7">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="chevron-updown" icon-position="left" class="justify-start">Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-7">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
