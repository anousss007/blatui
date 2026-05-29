<h3 class="flex">
    <button
        type="button"
        data-slot="accordion-trigger"
        @click="toggle(_v)"
        :data-state="isOpen(_v) ? 'open' : 'closed'"
        :aria-expanded="isOpen(_v)"
        {{ $attributes->twMerge('focus-visible:border-ring focus-visible:ring-ring/50 flex flex-1 items-start justify-between gap-4 rounded-md py-4 text-left text-sm font-medium transition-all outline-none hover:underline focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50 [&[data-state=open]>svg]:rotate-180') }}
    >
        {{ $slot }}
        <x-lucide-chevron-down class="text-muted-foreground pointer-events-none size-4 shrink-0 translate-y-0.5 transition-transform duration-200" />
    </button>
</h3>
