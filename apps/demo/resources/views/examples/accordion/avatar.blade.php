{{-- Rich trigger with an avatar, name and supporting line. --}}
<x-ui.accordion type="single" collapsible value="item-1" class="w-full max-w-md">
    <x-ui.accordion-item value="item-1">
        <x-ui.accordion-trigger icon="chevron-updown" class="items-center hover:no-underline">
            <span class="flex items-center gap-3">
                <x-ui.avatar class="size-9"><x-ui.avatar-fallback>RP</x-ui.avatar-fallback></x-ui.avatar>
                <span class="flex flex-col">
                    <span>Richard Payne</span>
                    <span class="text-muted-foreground text-xs font-normal">Account &amp; billing</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-12">Manage your plan, payment method and invoices from the billing page in your dashboard.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-2">
        <x-ui.accordion-trigger icon="chevron-updown" class="items-center hover:no-underline">
            <span class="flex items-center gap-3">
                <x-ui.avatar class="size-9"><x-ui.avatar-fallback>SM</x-ui.avatar-fallback></x-ui.avatar>
                <span class="flex flex-col">
                    <span>Sofia Mills</span>
                    <span class="text-muted-foreground text-xs font-normal">Orders &amp; shipping</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-12">Track shipments, start a return, or update a delivery address before your order is dispatched.</x-ui.accordion-content>
    </x-ui.accordion-item>
    <x-ui.accordion-item value="item-3">
        <x-ui.accordion-trigger icon="chevron-updown" class="items-center hover:no-underline">
            <span class="flex items-center gap-3">
                <x-ui.avatar class="size-9"><x-ui.avatar-fallback>AK</x-ui.avatar-fallback></x-ui.avatar>
                <span class="flex flex-col">
                    <span>Amir Khan</span>
                    <span class="text-muted-foreground text-xs font-normal">Privacy &amp; security</span>
                </span>
            </span>
        </x-ui.accordion-trigger>
        <x-ui.accordion-content class="ps-12">Enable two-factor authentication and review active sessions from your security settings.</x-ui.accordion-content>
    </x-ui.accordion-item>
</x-ui.accordion>
