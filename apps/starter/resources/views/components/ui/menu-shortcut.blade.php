@props(['dataSlot' => 'menu-shortcut'])

<span data-slot="{{ $dataSlot }}" {{ $attributes->twMerge('text-muted-foreground ms-auto text-xs tracking-widest') }}>{{ $slot }}</span>
