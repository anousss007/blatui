<x-ui.resizable-panel-group direction="vertical" class="min-h-[200px] max-w-md rounded-lg border md:min-w-[450px]">
    <x-ui.resizable-panel :primary="true">
        <div class="flex h-full items-center justify-center p-6">
            <span class="font-semibold">Header</span>
        </div>
    </x-ui.resizable-panel>
    <x-ui.resizable-handle data-direction="vertical" />
    <x-ui.resizable-panel>
        <div class="flex h-full items-center justify-center p-6">
            <span class="font-semibold">Content</span>
        </div>
    </x-ui.resizable-panel>
</x-ui.resizable-panel-group>
