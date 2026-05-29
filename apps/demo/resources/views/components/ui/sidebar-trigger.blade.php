<button
    type="button"
    @click="toggle()"
    data-slot="sidebar-trigger"
    aria-label="Toggle Sidebar"
    {{ $attributes->twMerge('hover:bg-accent hover:text-accent-foreground inline-flex size-7 items-center justify-center rounded-md transition-colors outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]') }}
>
    <x-lucide-panel-left class="size-4" />
    <span class="sr-only">Toggle Sidebar</span>
</button>
