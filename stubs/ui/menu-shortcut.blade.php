@props(['dataSlot' => 'menu-shortcut'])

<span data-slot="{{ $dataSlot }}" {{ $attributes->twMerge('text-muted-foreground ml-auto text-xs tracking-widest') }}>{{ $slot }}</span>
