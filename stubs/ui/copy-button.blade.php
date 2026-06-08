{{--
    Copy-to-clipboard button. Copies `value`, flips the icon to a check, and announces "Copied"
    to screen readers via an aria-live region. Pass a slot for an optional text label.
      value   the string to copy
      label   accessible label (default "Copy"); becomes "Copied" after a copy
--}}
@props([
    'value' => '',
    'label' => 'Copy',
])

<button
    type="button"
    x-data="{ copied: false, copy() { navigator.clipboard.writeText(@js((string) $value)); this.copied = true; clearTimeout(this._t); this._t = setTimeout(() => this.copied = false, 1500); } }"
    @click="copy()"
    :aria-label="copied ? 'Copied' : @js($label)"
    data-slot="copy-button"
    {{ $attributes->twMerge('text-muted-foreground hover:text-foreground hover:bg-accent inline-flex h-8 items-center justify-center gap-1.5 rounded-md px-2 text-sm font-medium transition-colors outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50') }}
>
    <span class="grid size-4 place-items-center *:col-start-1 *:row-start-1">
        <x-lucide-copy class="size-4 transition-all duration-150" x-bind:class="copied ? 'scale-0 opacity-0' : 'scale-100 opacity-100'" aria-hidden="true" />
        <x-lucide-check class="text-success size-4 transition-all duration-150" x-bind:class="copied ? 'scale-100 opacity-100' : 'scale-0 opacity-0'" aria-hidden="true" />
    </span>
    @if ($slot->isNotEmpty())<span>{{ $slot }}</span>@endif
    <span class="sr-only" aria-live="polite" x-text="copied ? 'Copied' : ''"></span>
</button>
