{{-- Feature rows: a leading icon + label paired with a switch. --}}
<div class="flex w-full max-w-sm flex-col gap-4">
    <label for="sw-sync" class="flex items-center justify-between gap-4">
        <span class="flex items-center gap-3">
            <x-lucide-database class="text-muted-foreground size-5" />
            <span class="flex flex-col">
                <span class="text-sm font-medium">Sync data</span>
                <span class="text-muted-foreground text-xs">Keep records up to date across devices.</span>
            </span>
        </span>
        <x-ui.switch id="sw-sync" checked />
    </label>

    <label for="sw-theme" class="flex items-center justify-between gap-4">
        <span class="flex items-center gap-3">
            <x-lucide-palette class="text-muted-foreground size-5" />
            <span class="flex flex-col">
                <span class="text-sm font-medium">Auto theme</span>
                <span class="text-muted-foreground text-xs">Match the system light / dark setting.</span>
            </span>
        </span>
        <x-ui.switch id="sw-theme" />
    </label>

    <label for="sw-ai" class="flex items-center justify-between gap-4">
        <span class="flex items-center gap-3">
            <x-lucide-sparkles class="text-muted-foreground size-5" />
            <span class="flex flex-col">
                <span class="text-sm font-medium">AI suggestions</span>
                <span class="text-muted-foreground text-xs">Surface smart recommendations as you work.</span>
            </span>
        </span>
        <x-ui.switch id="sw-ai" checked />
    </label>
</div>
