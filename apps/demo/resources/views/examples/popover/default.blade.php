<x-ui.popover>
    <x-ui.popover-trigger>
        <x-ui.button variant="outline">Open popover</x-ui.button>
    </x-ui.popover-trigger>
    <x-ui.popover-content class="w-80">
        <div class="grid gap-4">
            <div class="space-y-2">
                <h4 class="leading-none font-medium">Dimensions</h4>
                <p class="text-muted-foreground text-sm">Set the dimensions for the layer.</p>
            </div>
            <div class="grid gap-2">
                <div class="grid grid-cols-3 items-center gap-4">
                    <x-ui.label for="width">Width</x-ui.label>
                    <x-ui.input id="width" value="100%" class="col-span-2 h-8" />
                </div>
                <div class="grid grid-cols-3 items-center gap-4">
                    <x-ui.label for="maxWidth">Max. width</x-ui.label>
                    <x-ui.input id="maxWidth" value="300px" class="col-span-2 h-8" />
                </div>
                <div class="grid grid-cols-3 items-center gap-4">
                    <x-ui.label for="height">Height</x-ui.label>
                    <x-ui.input id="height" value="25px" class="col-span-2 h-8" />
                </div>
                <div class="grid grid-cols-3 items-center gap-4">
                    <x-ui.label for="maxHeight">Max. height</x-ui.label>
                    <x-ui.input id="maxHeight" value="none" class="col-span-2 h-8" />
                </div>
            </div>
        </div>
    </x-ui.popover-content>
</x-ui.popover>
