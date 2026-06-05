{{-- Decorative divider: a real role=separator is not an allowed child of role=listbox,
     and the groups already convey structure, so this is hidden from assistive tech. --}}
<div data-slot="command-separator" aria-hidden="true" {{ $attributes->twMerge('bg-border -mx-1 h-px') }}></div>
