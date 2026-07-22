@props(['placeholder' => ''])

<span
    data-slot="select-value"
    {{ $attributes->twMerge('pointer-events-none flex flex-1 flex-wrap items-center gap-1') }}
>
    {{-- single-select label --}}
    <span x-show="!multiple" x-text="label || @js($placeholder)" :class="{ 'text-muted-foreground': !label }"></span>

    {{-- multi-select: placeholder when empty, else removable chips --}}
    <span x-show="multiple && !selected.length" class="text-muted-foreground">{{ $placeholder }}</span>
    <template x-for="o in selected" :key="o.value">
        <span x-show="multiple" class="bg-secondary text-secondary-foreground inline-flex items-center gap-1 rounded px-1.5 py-0.5 text-xs font-medium">
            <span x-text="o.label"></span>
            <span role="button" tabindex="-1" :aria-label="'Remove ' + o.label" @click.stop.prevent="remove(o.value)"
                class="hover:text-foreground/70 pointer-events-auto inline-flex cursor-pointer items-center rounded-sm outline-none">
                <x-lucide-x class="size-3" aria-hidden="true" />
            </span>
        </span>
    </template>
</span>
