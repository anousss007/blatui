<div class="flex flex-wrap items-center gap-2">
    <x-ui.button variant="outline" x-on:click="window.toast.success('Event has been created')">
        Success
    </x-ui.button>
    <x-ui.button variant="outline" x-on:click="window.toast.error('Something went wrong')">
        Error
    </x-ui.button>
    <x-ui.button variant="outline" x-on:click="window.toast({ title: 'Scheduled: Catch up', description: 'Friday, February 10, 2023 at 5:57 PM' })">
        Description
    </x-ui.button>
</div>

<x-ui.sonner />
