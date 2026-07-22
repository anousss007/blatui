@props([
    'dataSlot' => 'menu-group',
    // selector pointing at the family's own *-label slot for aria-labelledby wiring
    'labelSlot' => 'menu-label',
    // dropdown renders a single-line div (data-slot first); context/menubar render a
    // multi-line div (role first). compact=true reproduces the dropdown layout exactly.
    'compact' => false,
])

@if ($compact)
<div data-slot="{{ $dataSlot }}" role="group" x-blat-labelledby="{ label: ':scope > [data-slot={{ $labelSlot }}]' }" {{ $attributes }}>{{ $slot }}</div>
@else
<div role="group" data-slot="{{ $dataSlot }}" x-blat-labelledby="{ label: ':scope > [data-slot={{ $labelSlot }}]' }" {{ $attributes }}>
    {{ $slot }}
</div>
@endif
