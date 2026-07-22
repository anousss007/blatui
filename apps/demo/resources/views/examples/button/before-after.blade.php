{{-- Optional `before` / `after` named slots hoist an icon to the start/end of the label,
     with sizing handled for you. `as` renders the button as a different element. --}}
<div class="flex flex-wrap items-center gap-3">
    <x-ui.button>
        <x-slot:before><x-lucide-download /></x-slot:before>
        Download
    </x-ui.button>

    <x-ui.button variant="outline">
        Continue
        <x-slot:after><x-lucide-arrow-right /></x-slot:after>
    </x-ui.button>

    {{-- as="label": a button-styled <label> wrapping a hidden file input. --}}
    <x-ui.button as="label" variant="secondary" class="cursor-pointer">
        <x-slot:before><x-lucide-upload /></x-slot:before>
        Upload file
        <input type="file" class="sr-only">
    </x-ui.button>
</div>
