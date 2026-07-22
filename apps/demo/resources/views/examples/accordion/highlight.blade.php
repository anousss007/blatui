{{-- The active item is highlighted with an accent colour and a coloured divider. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1" class="data-[state=open]:border-primary not-last:data-[state=open]:border-b-2">
        <x-ui.accordion-trigger class="in-data-[state=open]:text-primary">How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2" class="data-[state=open]:border-primary not-last:data-[state=open]:border-b-2">
        <x-ui.accordion-trigger class="in-data-[state=open]:text-primary">What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3" class="data-[state=open]:border-primary not-last:data-[state=open]:border-b-2">
        <x-ui.accordion-trigger class="in-data-[state=open]:text-primary">Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
