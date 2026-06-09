{{-- A toast with an action button (e.g. Undo). --}}
<div class="flex flex-wrap items-center gap-2">
    <x-ui.button variant="outline"
        x-on:click="window.toast({ title: 'Event deleted', description: 'The event has been removed from your calendar.', action: { label: 'Undo', onClick: () => window.toast.success('Event restored') } })">
        Show toast
    </x-ui.button>
</div>

<x-ui.sonner />
