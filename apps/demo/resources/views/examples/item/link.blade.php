{{-- Clickable item rows (rendered as links) with a trailing chevron. --}}
<x-ui.item-group class="w-full max-w-md rounded-lg border">
    <x-ui.item href="#" class="hover:bg-accent transition-colors">
        <x-ui.item-media variant="icon"><x-lucide-user /></x-ui.item-media>
        <x-ui.item-content><x-ui.item-title>Account</x-ui.item-title></x-ui.item-content>
        <x-ui.item-actions><x-lucide-chevron-right class="text-muted-foreground size-4" /></x-ui.item-actions>
    </x-ui.item>
    <x-ui.item-separator />
    <x-ui.item href="#" class="hover:bg-accent transition-colors">
        <x-ui.item-media variant="icon"><x-lucide-credit-card /></x-ui.item-media>
        <x-ui.item-content><x-ui.item-title>Billing</x-ui.item-title></x-ui.item-content>
        <x-ui.item-actions><x-lucide-chevron-right class="text-muted-foreground size-4" /></x-ui.item-actions>
    </x-ui.item>
    <x-ui.item-separator />
    <x-ui.item href="#" class="hover:bg-accent transition-colors">
        <x-ui.item-media variant="icon"><x-lucide-shield /></x-ui.item-media>
        <x-ui.item-content><x-ui.item-title>Security</x-ui.item-title></x-ui.item-content>
        <x-ui.item-actions><x-lucide-chevron-right class="text-muted-foreground size-4" /></x-ui.item-actions>
    </x-ui.item>
</x-ui.item-group>
