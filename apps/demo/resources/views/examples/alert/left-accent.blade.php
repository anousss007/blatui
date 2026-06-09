{{-- Tinted callouts with a thick coloured bar on the leading edge. --}}
<div class="flex w-full max-w-xl flex-col gap-3">
    <x-ui.alert class="bg-success/10 text-success rounded-md border-0 border-l-4 border-success [&>svg]:text-success">
        <x-lucide-circle-check />
        <x-ui.alert-title>Your request to join the team is approved.</x-ui.alert-title>
    </x-ui.alert>
    <x-ui.alert class="bg-info/10 text-info rounded-md border-0 border-l-4 border-info [&>svg]:text-info">
        <x-lucide-info />
        <x-ui.alert-title>A new comment was added to your document.</x-ui.alert-title>
    </x-ui.alert>
    <x-ui.alert class="bg-destructive/10 text-destructive rounded-md border-0 border-l-4 border-destructive [&>svg]:text-destructive">
        <x-lucide-circle-x />
        <x-ui.alert-title>This file could not be uploaded.</x-ui.alert-title>
    </x-ui.alert>
</div>
