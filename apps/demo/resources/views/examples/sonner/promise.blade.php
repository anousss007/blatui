{{-- A promise toast: loading → success/error on settle. --}}
<div class="flex flex-wrap items-center gap-2">
    <x-ui.button variant="outline"
        x-on:click="window.toast.promise(new Promise((resolve) => setTimeout(resolve, 2000)), { loading: 'Saving changes…', success: 'Changes saved', error: 'Could not save' })">
        Show promise toast
    </x-ui.button>
</div>

<x-ui.sonner />
