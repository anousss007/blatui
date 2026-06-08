@php $menuId = 'menubar-'.\Illuminate\Support\Str::random(8); @endphp

<div data-slot="menubar-menu" x-data="{ id: @js($menuId) }" {{ $attributes->twMerge('relative') }}>
    {{ $slot }}
</div>
