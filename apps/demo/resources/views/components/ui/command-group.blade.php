@props(['heading' => null])

<div
    data-slot="command-group"
    role="group"
    {{-- Named by the heading text rather than by an idref: the id that pair needed was
         generated per render, and Livewire keys a morph on `el.id` — so the heading was replaced
         on every re-render instead of patched. #27 --}}
    @if ($heading) aria-label="{{ $heading }}" @endif
    {{ $attributes->twMerge('text-foreground overflow-hidden p-1') }}
>
    @if ($heading)
        <div data-slot="command-group-heading" aria-hidden="true" class="text-muted-foreground px-2 py-1.5 text-xs font-medium">{{ $heading }}</div>
    @endif
    {{ $slot }}
</div>
