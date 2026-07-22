{{-- Fully rounded checkboxes. --}}
<div class="flex flex-wrap items-center gap-5">
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-round-1" class="rounded-full" />
        <x-ui.label for="cb-round-1">Unchecked</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-round-2" checked class="rounded-full" />
        <x-ui.label for="cb-round-2">Checked</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.checkbox id="cb-round-3" checked class="size-5 rounded-full data-[state=checked]:bg-success data-[state=checked]:border-success dark:data-[state=checked]:bg-success" />
        <x-ui.label for="cb-round-3">Large</x-ui.label>
    </div>
</div>
