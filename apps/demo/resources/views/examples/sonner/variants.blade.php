<div class="flex flex-wrap items-center gap-2">
    <x-ui.button variant="outline" x-on:click="window.toast.success('Changes saved')">Success</x-ui.button>
    <x-ui.button variant="outline" x-on:click="window.toast.error('Something went wrong')">Error</x-ui.button>
    <x-ui.button variant="outline" x-on:click="window.toast.warning('Your trial ends soon')">Warning</x-ui.button>
    <x-ui.button variant="outline" x-on:click="window.toast.info('A new version is available')">Info</x-ui.button>
</div>

<x-ui.sonner />
