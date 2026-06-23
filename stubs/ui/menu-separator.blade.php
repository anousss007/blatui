@props(['dataSlot' => 'menu-separator'])

<div data-slot="{{ $dataSlot }}" role="separator" aria-orientation="horizontal" {{ $attributes->twMerge('bg-border -mx-1 my-1 h-px') }}></div>
