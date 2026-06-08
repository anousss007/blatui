{{-- Pass `expand` to keep every toast visible as a list (no collapsing). --}}
<x-ui.button variant="outline" x-on:click="
    window.toast.success('Profile saved');
    window.toast('Settings synced');
    window.toast.info('New login from Chrome');
">
    Show toasts (expanded)
</x-ui.button>

<x-ui.sonner expand position="bottom-left" />
