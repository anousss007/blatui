{{-- Alert with a trailing action button. --}}
<x-ui.alert class="flex max-w-md items-center justify-between gap-3">
    <div class="flex items-center gap-3">
        <x-ui.avatar class="size-9 rounded-md"><x-ui.avatar-fallback class="rounded-md">SR</x-ui.avatar-fallback></x-ui.avatar>
        <div class="space-y-0.5">
            <x-ui.alert-title>Sara replied to your photo</x-ui.alert-title>
            <x-ui.alert-description>12 unread messages. Tap to see.</x-ui.alert-description>
        </div>
    </div>
    <x-ui.button variant="outline" size="sm">View</x-ui.button>
</x-ui.alert>
