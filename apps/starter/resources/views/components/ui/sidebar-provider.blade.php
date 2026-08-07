@props(['defaultOpen' => true])

@php
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
            const mq = window.matchMedia('(max-width: 767px)');
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
