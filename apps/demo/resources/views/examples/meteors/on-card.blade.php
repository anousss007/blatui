<x-ui.card class="w-full max-w-sm overflow-hidden p-0">
    <x-ui.meteors :count="14">
        <div class="flex flex-col gap-2 p-6">
            <div class="bg-primary/10 text-primary flex size-10 items-center justify-center rounded-lg">
                <x-lucide-sparkles class="size-5" aria-hidden="true" />
            </div>
            <h3 class="mt-2 text-lg font-semibold tracking-tight">Background magic</h3>
            <p class="text-muted-foreground text-sm text-balance">
                Drop meteors behind any card. They respect the theme colour and pause for
                reduced-motion users.
            </p>
        </div>
    </x-ui.meteors>
</x-ui.card>
