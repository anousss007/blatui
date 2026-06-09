{{-- A visible grip handle between panels. --}}
<x-ui.resizable-panel-group direction="horizontal" class="max-w-md rounded-lg border md:min-w-[450px]">
    <x-ui.resizable-panel :primary="true">
        <div class="flex h-[200px] items-center justify-center p-6">
            <span class="font-semibold">Sidebar</span>
        </div>
    </x-ui.resizable-panel>
    <x-ui.resizable-handle :with-handle="true" />
    <x-ui.resizable-panel>
        <div class="flex h-full items-center justify-center p-6">
            <span class="font-semibold">Content</span>
        </div>
    </x-ui.resizable-panel>
</x-ui.resizable-panel-group>
