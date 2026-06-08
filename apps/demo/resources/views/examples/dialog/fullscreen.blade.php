{{-- Pass `fullscreen` to dialog-content for an edge-to-edge takeover (mobile, editors, viewers). --}}
<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline">Open full-screen</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content fullscreen>
        <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col gap-6">
            <x-ui.dialog-header>
                <x-ui.dialog-title>Full-screen dialog</x-ui.dialog-title>
                <x-ui.dialog-description>
                    An edge-to-edge takeover — ideal on mobile, or for focused editing and media.
                </x-ui.dialog-description>
            </x-ui.dialog-header>

            <div class="flex-1 space-y-4">
                <div class="grid gap-2">
                    <x-ui.label for="fs-title">Title</x-ui.label>
                    <x-ui.input id="fs-title" placeholder="Untitled document" />
                </div>
                <div class="grid gap-2">
                    <x-ui.label for="fs-body">Body</x-ui.label>
                    <x-ui.textarea id="fs-body" rows="6" placeholder="Write something…" />
                </div>
            </div>

            <x-ui.dialog-footer>
                <x-ui.button variant="outline" @click="open = false">Cancel</x-ui.button>
                <x-ui.button @click="open = false">Save</x-ui.button>
            </x-ui.dialog-footer>
        </div>
    </x-ui.dialog-content>
</x-ui.dialog>
