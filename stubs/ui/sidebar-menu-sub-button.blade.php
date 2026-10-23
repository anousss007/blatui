@props([
    'href' => '#',
    'isActive' => false,
    'size' => 'md',
    'current' => false, // true or 'exact', as on the sidebar menu button
])

@php
    // `current` derives isActive from the page instead of taking it from the caller: matched
    // here for the first paint, then kept up to date in the browser by x-blat-current, which
    // is what a sidebar inside @persist (or a Livewire component re-rendered by an update
    // request, where the route is livewire.update) needs. Same rule as blatPathMatches() in
    // blatui-core.js and Livewire's wire:current: segment prefix by default, 'exact' for the
    // whole path, the root always exact. #54
    if ($current && $href) {
        $here = trim(class_exists(\Livewire\Livewire::class) ? \Livewire\Livewire::originalPath() : request()->path(), '/');
        $link = parse_url($href);
        $want = trim($link['path'] ?? '', '/');
        $isActive = (! isset($link['host']) || $link['host'] === request()->getHost())
            && ($current === 'exact' || $want === '' ? $here === $want : $here === $want || str_starts_with($here, $want.'/'));
    }

    $classes = 'text-sidebar-foreground ring-sidebar-ring hover:bg-sidebar-accent hover:text-sidebar-accent-foreground active:bg-sidebar-accent active:text-sidebar-accent-foreground [&>svg]:text-sidebar-accent-foreground data-[active=true]:bg-sidebar-accent data-[active=true]:text-sidebar-accent-foreground flex h-7 min-w-0 -translate-x-px items-center gap-2 overflow-hidden rounded-md px-2 outline-none focus-visible:ring-2 disabled:pointer-events-none disabled:opacity-50 aria-disabled:pointer-events-none aria-disabled:opacity-50 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0 group-data-[collapsible=icon]:hidden in-data-[flyout=open]:flex! '.($size === 'sm' ? 'text-xs' : 'text-sm');
@endphp

<a
    href="{{ $href }}"
    data-slot="sidebar-menu-sub-button"
    data-sidebar="menu-sub-button"
    data-size="{{ $size }}"
    @if ($isActive) data-active="true" aria-current="page" @endif
    @if ($current) x-blat-current="@js($current === 'exact' ? 'exact' : 'prefix')" @endif
    {{ $attributes->twMerge($classes) }}
>{{ $slot }}</a>
