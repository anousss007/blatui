<x-ui.popover>
    <x-ui.popover-trigger>
        <x-ui.button variant="outline"><x-lucide-share-2 aria-hidden="true" /> Share</x-ui.button>
    </x-ui.popover-trigger>
    <x-ui.popover-content class="w-80">
        <div class="grid gap-3">
            <div class="space-y-1">
                <h4 class="leading-none font-medium">Share link</h4>
                <p class="text-muted-foreground text-sm">Anyone with the link can view this page.</p>
            </div>
            <div class="flex items-center gap-2">
                <x-ui.input value="https://blatui.dev/x/8Fk2pQ" readonly aria-label="Share link" class="h-8" />
                <x-ui.button size="sm" variant="secondary"><x-lucide-link aria-hidden="true" /> Copy</x-ui.button>
            </div>
        </div>
    </x-ui.popover-content>
</x-ui.popover>
