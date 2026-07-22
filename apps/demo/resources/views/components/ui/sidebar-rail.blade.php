<button
    type="button"
    @click="toggle()"
    data-slot="sidebar-rail"
    data-sidebar="rail"
    aria-label="Toggle Sidebar"
    title="Toggle sidebar"
    tabindex="-1"
    {{ $attributes->twMerge('hover:after:bg-sidebar-border absolute inset-y-0 z-20 hidden w-4 -translate-x-1/2 cursor-pointer transition-all ease-linear group-data-[side=left]:-right-4 group-data-[side=right]:left-0 after:absolute after:inset-y-0 after:left-1/2 after:w-px sm:flex') }}
></button>
