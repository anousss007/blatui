<div data-slot="scroll-area" {{ $attributes->twMerge('relative') }}>
    <div
        data-slot="scroll-area-viewport"
        tabindex="0"
        role="region"
        class="focus-visible:ring-ring/50 size-full [scrollbar-width:thin] [scrollbar-color:var(--border)_transparent] overflow-auto rounded-[inherit] transition-[color,box-shadow] outline-none focus-visible:ring-[3px] focus-visible:outline-1"
    >
        {{ $slot }}
    </div>
</div>
