{{-- Plus / minus toggle icon instead of a chevron. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center">How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center">What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="plus-minus" class="items-center">Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
