{{--
    mobileBreakpoint  Viewport width below which the sidebar becomes an off-canvas drawer
                      instead of collapsing to the icon rail. Defaults to Tailwind's md
                      (767px). Raise it to 1023px to get the drawer on tablets too, where an
                      always-docked rail often costs more room than it earns. A bare number
                      is read as px; anything else is passed to matchMedia as written.
    persist           Remember the desktop expanded/collapsed state across page loads, in a
                      cookie (`sidebar_state`, or the name you pass instead of `true`). It is
                      read on the SERVER, so the first paint is already in the remembered state:
                      no flash, and a `wire:navigate` visit or a Livewire re-render renders it
                      right too. The cookie is set by JS and read from the raw Cookie header,
                      so Laravel's cookie encryption needs no exception for it. Two providers
                      on one page that both persist want different names. Also what lets a
                      sidebar kept in Livewire's @persist follow a trigger rendered outside it:
                      providers that share a cookie name share one live state.
--}}
@props(['defaultOpen' => true, 'mobileBreakpoint' => '767px', 'persist' => false])

@php
    // Keep in step with the identical lookup in sidebar.blade.php, which reads these two props
    // through @aware: the provider owns the state, the sidebar has to paint the same one.
    $cookieName = in_array($persist, [true, 'true'], true) ? 'sidebar_state' : (is_string($persist) && ! in_array($persist, ['', 'false'], true) ? $persist : null);
    $open = (bool) $defaultOpen;
    if ($cookieName && preg_match('/(?:^|;\s*)'.preg_quote($cookieName, '/').'=(true|false)(?:;|$)/', (string) request()->header('cookie'), $m)) {
        $open = $m[1] === 'true';
    }

    $mobileQuery = '(max-width: '.(is_numeric($mobileBreakpoint) ? $mobileBreakpoint.'px' : $mobileBreakpoint).')';

    // Merge our default CSS vars with any style passed by the block (e.g. a custom
    // --sidebar-width or --header-height). Passed declarations come last so they win,
    // and we drop the incoming `style` from the bag to avoid a duplicate attribute.
    // Both widths track the spacing scale: the collapsed rail has to keep matching the
    // menu button inside it (size-8), which scales with --spacing. 64 × .25rem = 16rem and
    // 12 × .25rem = 3rem, so the default is unchanged.
    $style = rtrim('--sidebar-width: calc(var(--spacing) * 64); --sidebar-width-icon: calc(var(--spacing) * 12); '.$attributes->get('style', ''));
@endphp

<div
    data-slot="sidebar-provider"
    {{-- The state lives in blatui-core.js (blatSidebarProvider), shared by every provider that
         persists under the same cookie name: a sidebar kept in @persist still holds the scope
         of the provider it was first rendered in, and a wire:navigate visit renders a new one
         around it. Sharing the state keeps the new page's trigger driving that sidebar (#57). --}}
    x-data="blatSidebarProvider({ open: {{ $open ? 'true' : 'false' }}, key: @js($cookieName), mobileQuery: @js($mobileQuery) })"
    style="{{ $style }}"
    {{ $attributes->except('style')->twMerge('group/sidebar-wrapper flex min-h-svh w-full has-data-[variant=inset]:bg-sidebar') }}
>
    {{ $slot }}
</div>
