{{--
    tooltip  Label shown on hover/focus while the sidebar is collapsed to the icon rail,
             where the button's text is clipped to nothing. Opt-in per button, like
             shadcn/ui's `tooltip` prop, and only rendered when it would say something the
             screen doesn't: the label <span> stays in the DOM when collapsed, so the
             accessible name is unaffected either way — this is for sighted pointer users.
--}}
@props([
    'href' => null,
    'isActive' => false,
    'variant' => 'default',
    'size' => 'default',
    'tooltip' => null,
])

@php
    $base = "peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-start text-sm outline-none ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-[[data-sidebar=menu-action]]/menu-item:pe-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0";
    $variants = [
        'default' => 'hover:bg-sidebar-accent hover:text-sidebar-accent-foreground',
        'outline' => 'bg-background shadow-[0_0_0_1px_var(--sidebar-border)] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground hover:shadow-[0_0_0_1px_var(--sidebar-accent)]',
    ];
    $sizes = [
        'default' => 'h-8 text-sm',
        'sm' => 'h-7 text-xs',
        'lg' => 'h-12 text-sm',
    ];
    // Emit exactly ONE collapsed-icon padding class so it can't conflict in twMerge:
    // lg buttons (logo/avatar fills the icon box) get p-0, the rest get p-2.
    $iconPad = $size === 'lg' ? 'group-data-[collapsible=icon]:p-0!' : 'group-data-[collapsible=icon]:p-2!';
    $classes = $base.' '.($variants[$variant] ?? $variants['default']).' '.($sizes[$size] ?? $sizes['default']).' '.$iconPad;

    // Visible only while the rail is collapsed. `$data.collapsed` rather than `collapsed`:
    // a menu button rendered outside a <x-ui.sidebar-provider> (the docs examples do this)
    // would otherwise log a ReferenceError on every evaluation.
    $tipState = 'tipOpen && $data.collapsed';
@endphp

@if ($tooltip)
    {{-- The wrapper owns `tipOpen`, never `open`: this button commonly sits inside a
         collapsible (named in prose — a tag here would register it as a dependency) and drives
         it with `open = !open`, so a nested scope introducing its own `open` would hijack that.
         Block + w-full so wrapping doesn't change the button's box, which the teleported
         tooltip also anchors to via $refs.trigger. --}}
    <div
        data-slot="sidebar-menu-button-tooltip"
        x-data="{ tipOpen: false }"
        x-id="['blat-tooltip']"
        @mouseenter="tipOpen = true"
        @mouseleave="tipOpen = false"
        @focusin="tipOpen = true"
        @focusout="tipOpen = false"
        {{-- menu-action and menu-badge style themselves off `peer-hover/menu-button` and
             `peer-data-[active=true]/menu-button`, which need the button to be their previous
             SIBLING. Wrapping it would break that, so the wrapper stands in as the peer. --}}
        @if ($isActive) data-active="true" @endif
        class="peer/menu-button block w-full"
    >
@endif

@if ($href)
    <a
        href="{{ $href }}"
        data-slot="sidebar-menu-button"
        data-sidebar="menu-button"
        data-size="{{ $size }}"
        @if ($isActive) data-active="true" aria-current="page" @endif
        @if ($tooltip) x-ref="trigger" :aria-describedby="{{ $tipState }} ? $id('blat-tooltip') : null" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</a>
@else
    <button
        type="button"
        data-slot="sidebar-menu-button"
        data-sidebar="menu-button"
        data-size="{{ $size }}"
        @if ($isActive) data-active="true" @endif
        @if ($tooltip) x-ref="trigger" :aria-describedby="{{ $tipState }} ? $id('blat-tooltip') : null" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</button>
@endif

@if ($tooltip)
        <x-ui.tooltip-content side="right" :state="$tipState" :arrow="false">{{ $tooltip }}</x-ui.tooltip-content>
    </div>
@endif
