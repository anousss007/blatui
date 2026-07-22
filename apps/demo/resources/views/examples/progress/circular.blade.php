<div class="flex flex-wrap items-center gap-6">
    <x-ui.progress circular :value="72" :size="76" show-value aria-label="Storage used" />
    <x-ui.progress circular :value="45" :size="60" :thickness="5" aria-label="Goal" />
    <x-ui.progress circular :value="90" :size="48" :thickness="5" class="text-emerald-500" aria-label="Uptime" />
    <x-ui.progress circular indeterminate :size="40" :thickness="4" aria-label="Loading" />
</div>
