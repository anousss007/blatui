{{-- Fire several toasts: they collapse into a stack — hover (or focus) to fan them out. --}}
<x-ui.button variant="outline" x-on:click="
    window.toast.success('Profile saved');
    window.toast({ title: 'Scheduled', description: 'Friday at 5:57 PM' });
    window.toast.info('New login from Chrome');
">
    Stack 3 toasts
</x-ui.button>

<x-ui.sonner />
