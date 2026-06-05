@props([
    'messages' => null,
])

@php
    // Mirrors shadcn's <FieldError errors={[...]} />: accepts slot content, a single
    // string, or an array of messages / { message } objects. One message renders as
    // text; several render as a bulleted list. Nothing renders when there's no content.
    $items = collect(is_array($messages) ? $messages : ($messages !== null && $messages !== '' ? [$messages] : []))
        ->map(fn ($m) => is_array($m) ? ($m['message'] ?? null) : $m)
        ->filter(fn ($m) => filled($m))
        ->unique()
        ->values();
    $hasSlot = trim($slot) !== '';
@endphp

@if ($hasSlot || $items->isNotEmpty())
    <div role="alert" data-slot="field-error" {{ $attributes->twMerge('text-destructive text-sm font-normal') }}>
        @if ($hasSlot)
            {{ $slot }}
        @elseif ($items->count() === 1)
            {{ $items->first() }}
        @else
            <ul class="ml-4 flex list-disc flex-col gap-1">
                @foreach ($items as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
