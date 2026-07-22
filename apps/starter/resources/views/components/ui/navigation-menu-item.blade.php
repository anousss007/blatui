@php $navId = 'nav-'.\Illuminate\Support\Str::random(8); @endphp

<li data-slot="navigation-menu-item" x-data="{ id: @js($navId) }" {{ $attributes->twMerge('relative') }}>
    {{ $slot }}
</li>
