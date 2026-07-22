<x-ui.radio-group value="all" class="gap-4">
    <div class="flex items-start gap-3">
        <x-ui.radio-group-item value="all" id="rn-all" class="mt-0.5" />
        <div class="grid gap-1">
            <x-ui.label for="rn-all">All new messages</x-ui.label>
            <p class="text-muted-foreground text-sm">Get notified for every new message.</p>
        </div>
    </div>
    <div class="flex items-start gap-3">
        <x-ui.radio-group-item value="mentions" id="rn-mentions" class="mt-0.5" />
        <div class="grid gap-1">
            <x-ui.label for="rn-mentions">Direct messages and mentions</x-ui.label>
            <p class="text-muted-foreground text-sm">Only notify me when I'm mentioned.</p>
        </div>
    </div>
    <div class="flex items-start gap-3">
        <x-ui.radio-group-item value="none" id="rn-none" class="mt-0.5" />
        <div class="grid gap-1">
            <x-ui.label for="rn-none">Nothing</x-ui.label>
            <p class="text-muted-foreground text-sm">Turn off all notifications.</p>
        </div>
    </div>
</x-ui.radio-group>
