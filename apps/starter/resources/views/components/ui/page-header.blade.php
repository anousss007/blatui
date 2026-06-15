@props([
    'title' => null,         // page title; may also be supplied via the `title` slot
    'description' => null,    // supporting copy; may also be supplied via the `description` slot
    'separator' => false,     // when true, draws a bottom border under the header
    'as' => 'h1',             // heading level for the title (h1..h6)
])

@php
    // Title comes from the `title` prop or the default slot; description from the
    // `description` prop or the `description` named slot.
    $hasTitle = filled(trim((string) $title)) || filled(trim((string) $slot));
    $hasDescription = filled(trim((string) $description));
@endphp

<div
    data-slot="page-header"
    {{ $attributes->twMerge(($separator ? 'border-b pb-6 ' : '').'flex flex-col gap-4') }}
>
    @isset($breadcrumb)
        <div>{{ $breadcrumb }}</div>
    @endisset

    <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-col gap-1.5">
            @if ($hasTitle)
                <{{ $as }} class="text-2xl font-bold tracking-tight text-balance text-foreground sm:text-3xl">
                    {{ $title ?? '' }}{{ $slot }}
                </{{ $as }}>
            @endif

            @if ($hasDescription)
                <p class="text-muted-foreground text-balance">{{ $description }}</p>
            @endif
        </div>

        @isset($actions)
            <div class="flex shrink-0 flex-wrap items-center gap-2">{{ $actions }}</div>
        @endisset
    </div>
</div>
