@props(['heading' => null])

<div
    data-slot="command-group"
    role="presentation"
    {{ $attributes->twMerge('text-foreground overflow-hidden p-1') }}
>
    @if ($heading)
        <div data-slot="command-group-heading" class="text-muted-foreground px-2 py-1.5 text-xs font-medium">{{ $heading }}</div>
    @endif
    {{ $slot }}
</div>
