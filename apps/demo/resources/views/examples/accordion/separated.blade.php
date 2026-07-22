{{-- Each item is a separate elevated card; chevron points left and rotates up. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md space-y-2">
    <x-ui.accordion-item value="item-1" class="bg-card rounded-lg border-b-0 shadow-md data-[state=open]:shadow-lg">
        <x-ui.accordion-trigger icon="chevron-left" class="rounded-lg px-5 py-2.5">How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2" class="bg-card rounded-lg border-b-0 shadow-md data-[state=open]:shadow-lg">
        <x-ui.accordion-trigger icon="chevron-left" class="rounded-lg px-5 py-2.5">What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3" class="bg-card rounded-lg border-b-0 shadow-md data-[state=open]:shadow-lg">
        <x-ui.accordion-trigger icon="chevron-left" class="rounded-lg px-5 py-2.5">Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
