<x-ui.collapsible class="flex w-[350px] flex-col gap-2">
    <div class="flex items-center justify-between gap-4 px-4">
        <h4 class="text-sm font-semibold">@peduarte starred 3 repositories</h4>
        <x-ui.collapsible-trigger class="inline-flex size-8 items-center justify-center rounded-md hover:bg-accent hover:text-accent-foreground">
            <x-lucide-chevrons-up-down class="size-4" />
            <span class="sr-only">Toggle</span>
        </x-ui.collapsible-trigger>
    </div>
    <div class="rounded-md border px-4 py-2 font-mono text-sm">
        @radix-ui/primitives
    </div>
    <x-ui.collapsible-content class="flex flex-col gap-2">
        <div class="rounded-md border px-4 py-2 font-mono text-sm">
            @radix-ui/colors
        </div>
        <div class="rounded-md border px-4 py-2 font-mono text-sm">
            @stitches/react
        </div>
    </x-ui.collapsible-content>
</x-ui.collapsible>
