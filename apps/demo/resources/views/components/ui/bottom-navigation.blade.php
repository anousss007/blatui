@props([
    'ariaLabel' => 'Bottom navigation',
])

{{--
    A mobile bottom tab bar. A <nav> landmark holding a flex row of equal-width
    items (each <x-ui.bottom-navigation-item> stretches via flex-1). Border-t,
    bg-background, fixed-ish height (~16). RTL-safe (no physical left/right).
--}}
<nav
    data-slot="bottom-navigation"
    aria-label="{{ $ariaLabel }}"
    {{ $attributes->twMerge('bg-background border-border flex h-16 w-full items-stretch border-t') }}
>
    {{ $slot }}
</nav>
