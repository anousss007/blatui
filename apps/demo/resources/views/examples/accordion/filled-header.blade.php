{{-- The trigger header has a filled (accent) background; each item is a bordered card. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md space-y-2">
    <x-ui.accordion-item value="item-1" class="overflow-hidden rounded-lg border last:border-b">
        <x-ui.accordion-trigger class="bg-accent px-5 data-[state=open]:rounded-b-none">How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5 pt-4">Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2" class="overflow-hidden rounded-lg border last:border-b">
        <x-ui.accordion-trigger class="bg-accent px-5 data-[state=open]:rounded-b-none">What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5 pt-4">Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3" class="overflow-hidden rounded-lg border last:border-b">
        <x-ui.accordion-trigger class="bg-accent px-5 data-[state=open]:rounded-b-none">Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content class="px-5 pt-4">Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
