{{-- Pill-shaped toggles via rounded-full. --}}
<div class="flex items-center gap-2">
    <x-ui.toggle class="rounded-full" aria-label="Like">
        <x-lucide-heart />
    </x-ui.toggle>
    <x-ui.toggle variant="outline" class="rounded-full" aria-label="Favourite">
        <x-lucide-star />
    </x-ui.toggle>
    <x-ui.toggle class="rounded-full" pressed aria-label="Bookmark">
        <x-lucide-bookmark />
    </x-ui.toggle>
</div>
