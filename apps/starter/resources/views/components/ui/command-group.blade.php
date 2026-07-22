@props(['heading' => null])

@php $headingId = $heading ? 'cmd-grp-'.\Illuminate\Support\Str::random(8) : null; @endphp

<div
    data-slot="command-group"
    role="group"
    @if ($heading) aria-labelledby="{{ $headingId }}" @endif
    {{ $attributes->twMerge('text-foreground overflow-hidden p-1') }}
>
    @if ($heading)
        <div data-slot="command-group-heading" id="{{ $headingId }}" aria-hidden="true" class="text-muted-foreground px-2 py-1.5 text-xs font-medium">{{ $heading }}</div>
    @endif
    {{ $slot }}
</div>
