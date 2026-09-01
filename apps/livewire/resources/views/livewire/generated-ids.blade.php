<div>
    <h1 class="text-2xl font-bold">generated ids under a morph</h1>

    <div class="mt-6 flex gap-3">
        <x-ui.button wire:click="tick" data-testid="tick">Re-render</x-ui.button>
    </div>
    <p class="text-muted-foreground mt-2 text-sm">ticks: <span data-testid="ticks">{{ $ticks }}</span></p>

    {{-- Every component here once rendered an id it made up itself. None takes an `id` prop
         below, because that is the case that broke: a consumer who passes one has always been
         fine, and a component should not need them to. --}}
    <div class="mt-6 max-w-xl space-y-6">
        <div data-testid="color-picker"><x-ui.color-picker inline /></div>
        <div data-testid="rich-text-editor"><x-ui.rich-text-editor /></div>
        <div data-testid="mention-input"><x-ui.mention-input :mentions="[['value' => 'ada', 'label' => 'Ada']]" /></div>
        <div data-testid="markdown-editor"><x-ui.markdown-editor /></div>
        <div data-testid="segmented-control"><x-ui.segmented-control :options="['Day', 'Week']" /></div>
        <div data-testid="variant-selector"><x-ui.variant-selector :options="['S', 'M']" label="Size" /></div>
        {{-- Bare, not inside <x-ui.command>: the palette's own Alpine scope is not what is
             under test here, only the heading this group used to name with a generated id. --}}
        <div data-testid="command-group"><x-ui.command-group heading="Suggestions">…</x-ui.command-group></div>
    </div>
</div>
