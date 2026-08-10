{{--
    mobileBreakpoint  Viewport width below which the sidebar becomes an off-canvas drawer
                      instead of collapsing to the icon rail. Defaults to Tailwind's md
                      (767px). Raise it to 1023px to get the drawer on tablets too, where an
                      always-docked rail often costs more room than it earns. A bare number
                      is read as px; anything else is passed to matchMedia as written.
--}}
@props(['defaultOpen' => true, 'mobileBreakpoint' => '767px'])

@php
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
    x-data="{
        open: {{ $defaultOpen ? 'true' : 'false' }},
        openMobile: false,
        isMobile: false,
        collapsed: false,
        toggle() { this.isMobile ? (this.openMobile = !this.openMobile) : (this.open = !this.open) },
        init() {
            const mq = window.matchMedia(@js($mobileQuery));
            this.isMobile = mq.matches;
            mq.addEventListener('change', e => this.isMobile = e.matches);
        }
    }"
    {{-- `collapsed` is a plain property kept in sync, deliberately NOT a getter. Alpine
         resolves a getter's `this` against the scope that READS it (mergeProxies passes the
         reading proxy as the receiver), so `!this.open` inside a getter would pick up the
         `open` of whatever tooltip or collapsible the reader sits in — inverted, silently.
         A plain value is read straight off this scope, wherever it is read from. --}}
    x-effect="collapsed = !isMobile && !open"
    style="{{ $style }}"
    {{ $attributes->except('style')->twMerge('group/sidebar-wrapper flex min-h-svh w-full has-data-[variant=inset]:bg-sidebar') }}
>
    {{ $slot }}
</div>
