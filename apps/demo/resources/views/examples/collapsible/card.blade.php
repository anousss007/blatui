<x-ui.collapsible class="w-full max-w-sm">
    <x-ui.card>
        <x-ui.card-header>
            <x-ui.card-title>Deployment</x-ui.card-title>
            <x-ui.card-description>Production build · 2 minutes ago</x-ui.card-description>
            <x-ui.card-action>
                <x-ui.collapsible-trigger class="hover:bg-accent inline-flex size-8 items-center justify-center rounded-md">
                    <x-lucide-chevrons-up-down class="size-4" aria-hidden="true" />
                    <span class="sr-only">Toggle details</span>
                </x-ui.collapsible-trigger>
            </x-ui.card-action>
        </x-ui.card-header>
        <x-ui.collapsible-content>
            <x-ui.card-content class="text-muted-foreground flex flex-col gap-2 text-sm">
                <div class="flex justify-between"><span>Commit</span><span class="font-mono">a1b2c3d</span></div>
                <div class="flex justify-between"><span>Branch</span><span class="font-mono">main</span></div>
                <div class="flex justify-between"><span>Duration</span><span>48s</span></div>
            </x-ui.card-content>
        </x-ui.collapsible-content>
    </x-ui.card>
</x-ui.collapsible>
