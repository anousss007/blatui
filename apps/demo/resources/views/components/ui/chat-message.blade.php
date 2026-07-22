@props([
    'role' => 'assistant', // 'user' aligns inline-end with a primary bubble; anything else is assistant
    'name' => null,
    'time' => null,
    'avatar' => null,      // image url; falls back to initials from $name (or a generic glyph)
    'typing' => false,     // render 3 animated dots instead of slot content
])

@php
    $isUser = $role === 'user';

    // Initials for the avatar fallback when no image is supplied (first + last word).
    $initials = '';
    if ($name) {
        $parts = array_values(array_filter(preg_split('/\s+/', trim($name))));
        if (count($parts) >= 2) {
            $initials = strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[count($parts) - 1], 0, 1));
        } elseif (count($parts) === 1) {
            $initials = strtoupper(mb_substr($parts[0], 0, 2));
        }
    }
@endphp

<div
    data-slot="chat-message"
    @class([
        'flex items-end gap-2',
        'flex-row-reverse' => $isUser,
    ])
    {{ $attributes }}
>
    {{-- Avatar (image or initials). Decorative relative to the text, so labelled minimally. --}}
    <x-ui.avatar @class(['shrink-0', 'bg-muted' => ! $avatar])>
        @if ($avatar)
            <x-ui.avatar-image :src="$avatar" :alt="$name ? $name : ''" />
            <x-ui.avatar-fallback>{{ $initials ?: '?' }}</x-ui.avatar-fallback>
        @elseif ($initials)
            <x-ui.avatar-fallback class="text-foreground">{{ $initials }}</x-ui.avatar-fallback>
        @else
            <x-ui.avatar-fallback class="text-muted-foreground">
                <x-dynamic-component :component="'lucide-'.($isUser ? 'user' : 'bot')" class="size-4" aria-hidden="true" />
            </x-ui.avatar-fallback>
        @endif
    </x-ui.avatar>

    {{-- Column: optional meta line + bubble --}}
    <div @class([
        'flex min-w-0 flex-col gap-1',
        'items-end' => $isUser,
        'items-start' => ! $isUser,
    ])>
        @if ($name || $time)
            <div class="flex items-center gap-2 px-1 text-xs text-muted-foreground">
                @if ($name)
                    <span class="font-medium">{{ $name }}</span>
                @endif
                @if ($time)
                    <span>{{ $time }}</span>
                @endif
            </div>
        @endif

        <div @class([
            'max-w-[80%] rounded-2xl px-3.5 py-2 text-sm break-words',
            'bg-primary text-primary-foreground rounded-ee-sm' => $isUser,
            'bg-muted text-foreground rounded-es-sm' => ! $isUser,
        ])>
            @if ($typing)
                <span class="flex items-center gap-1 py-1" role="status" aria-label="{{ $name ? $name . ' is typing' : 'Typing' }}">
                    <span class="size-2 animate-bounce rounded-full bg-current opacity-60 [animation-delay:-0.3s]" aria-hidden="true"></span>
                    <span class="size-2 animate-bounce rounded-full bg-current opacity-60 [animation-delay:-0.15s]" aria-hidden="true"></span>
                    <span class="size-2 animate-bounce rounded-full bg-current opacity-60" aria-hidden="true"></span>
                </span>
            @else
                {{ $slot }}
            @endif
        </div>
    </div>
</div>
