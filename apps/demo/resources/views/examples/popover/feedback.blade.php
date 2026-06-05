<x-ui.popover>
    <x-ui.popover-trigger>
        <x-ui.button variant="outline"><x-lucide-message-square aria-hidden="true" /> Feedback</x-ui.button>
    </x-ui.popover-trigger>
    <x-ui.popover-content class="w-80">
        <form class="grid gap-3">
            <div class="space-y-1">
                <h4 class="leading-none font-medium">Send feedback</h4>
                <p class="text-muted-foreground text-sm">We'd love to hear what went well or could be better.</p>
            </div>
            <x-ui.textarea placeholder="Your feedback..." class="min-h-24" aria-label="Your feedback" />
            <x-ui.button type="submit" size="sm" class="w-full">Send feedback</x-ui.button>
        </form>
    </x-ui.popover-content>
</x-ui.popover>
