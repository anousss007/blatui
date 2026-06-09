{{-- A stat toggle: icon, label and a trailing count. --}}
<div class="flex items-center gap-2">
    <x-ui.toggle variant="outline" aria-label="Upvote">
        <x-lucide-arrow-big-up />
        Upvote
        <span class="text-muted-foreground tabular-nums">27</span>
    </x-ui.toggle>
    <x-ui.toggle variant="outline" pressed aria-label="Star on GitHub">
        <x-lucide-star />
        Star
        <span class="text-muted-foreground tabular-nums">1.2k</span>
    </x-ui.toggle>
</div>
