<x-ui.sheet>
    <x-ui.sheet-trigger>
        <x-ui.button variant="outline">Release notes</x-ui.button>
    </x-ui.sheet-trigger>
    <x-ui.sheet-content side="right">
        <x-ui.sheet-header>
            <x-ui.sheet-title>Release notes</x-ui.sheet-title>
            <x-ui.sheet-description>Everything new in this version.</x-ui.sheet-description>
        </x-ui.sheet-header>
        <div class="text-muted-foreground flex flex-1 flex-col gap-3 overflow-y-auto px-4 text-sm">
            <p>We rebuilt the component engine for faster first paint and smaller bundles.</p>
            <p>Every overlay now traps focus and restores it to the trigger on close.</p>
            <p>The theme customizer gained six new base colors and an export button.</p>
            <p>Tables support row selection, sticky headers, and inline row actions.</p>
            <p>Forms compose accessible fields with descriptions and error messages.</p>
            <p>Charts ship with thirty ready-made variations across six chart types.</p>
        </div>
        <x-ui.sheet-footer>
            <x-ui.button x-on:click="open = false">Got it</x-ui.button>
        </x-ui.sheet-footer>
    </x-ui.sheet-content>
</x-ui.sheet>
