{{-- Segmented alert with a coloured icon panel on the leading edge. --}}
<x-ui.alert class="flex max-w-md items-stretch gap-0 overflow-hidden p-0">
    <div class="bg-destructive/10 text-destructive flex items-center border-r p-3">
        <x-lucide-shield-alert class="size-4" />
    </div>
    <div class="flex items-center p-3">
        <x-ui.alert-title>This file may contain a virus.</x-ui.alert-title>
    </div>
</x-ui.alert>
