{{-- Coloured progress bars via the semantic tokens. --}}
<div class="flex w-full max-w-md flex-col gap-4">
    <x-ui.progress :value="72" class="bg-success/20 *:data-[slot=progress-indicator]:bg-success" />
    <x-ui.progress :value="56" class="bg-info/20 *:data-[slot=progress-indicator]:bg-info" />
    <x-ui.progress :value="38" class="bg-warning/20 *:data-[slot=progress-indicator]:bg-warning" />
    <x-ui.progress :value="20" class="bg-destructive/20 *:data-[slot=progress-indicator]:bg-destructive" />
</div>
