<x-ui.card class="w-full max-w-sm overflow-hidden pt-0">
    {{-- Cover image: decorative placeholder here (use a real <img> with descriptive alt in your app) --}}
    <div class="bg-muted aspect-video w-full" aria-hidden="true"></div>
    <x-ui.card-header>
        <x-ui.card-title>Exploring the mountains</x-ui.card-title>
        <x-ui.card-description>A short trip above the clouds.</x-ui.card-description>
        <x-ui.card-action>
            <x-ui.badge variant="secondary">Travel</x-ui.badge>
        </x-ui.card-action>
    </x-ui.card-header>
    <x-ui.card-content class="text-muted-foreground text-sm">
        Cards group related content and actions, with an optional cover image that bleeds to the edges.
    </x-ui.card-content>
    <x-ui.card-footer class="gap-2">
        <x-ui.button>Read more</x-ui.button>
        <x-ui.button variant="outline">Share</x-ui.button>
    </x-ui.card-footer>
</x-ui.card>
