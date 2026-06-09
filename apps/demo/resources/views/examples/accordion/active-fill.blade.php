{{-- The open item gets a filled (accent) background. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1" class="rounded-lg border-none px-5 transition-colors duration-200 data-[state=open]:bg-accent">
        <x-ui.accordion-trigger>How do I track my order?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Once your order ships, we'll email you a tracking link. You can also find it under Orders in your account.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2" class="rounded-lg border-none px-5 transition-colors duration-200 data-[state=open]:bg-accent">
        <x-ui.accordion-trigger>What is your return policy?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Returns are free within 30 days of delivery. Items must be unused and in their original packaging.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3" class="rounded-lg border-none px-5 transition-colors duration-200 data-[state=open]:bg-accent">
        <x-ui.accordion-trigger>Do you ship internationally?</x-ui.accordion-trigger>
        <x-ui.accordion-content>Yes — we ship to most countries. Costs and delivery estimates are shown at checkout.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
