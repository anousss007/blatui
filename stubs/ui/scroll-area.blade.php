<div data-slot="scroll-area" {{ $attributes->twMerge('relative') }}>
    <div
        data-slot="scroll-area-viewport"
        class="size-full rounded-[inherit] overflow-auto outline-none transition-[color,box-shadow] focus-visible:ring-ring/50 focus-visible:ring-[3px] focus-visible:outline-1 [scrollbar-width:thin] [scrollbar-color:var(--border)_transparent]"
    >
        {{ $slot }}
    </div>
</div>
