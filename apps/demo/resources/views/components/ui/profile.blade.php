{{--
    Profile — an avatar paired with a name (and optional secondary line). Commonly used as a
    sidebar/menu account button or a dropdown trigger. (Parity with Flux's <flux:profile>.)
      name         the display name
      avatar       avatar image URL (falls back to initials when absent or it fails to load)
      initials     fallback text inside the avatar (defaults to initials derived from `name`)
      description  optional secondary line (email, role…)
      as           button (default) | a | div
      href         link target when as="a"
      size         sm | default
      chevron      show a trailing up/down chevron (defaults to true when as="button")
--}}
@props([
    'name' => null,
    'avatar' => null,
    'initials' => null,
    'description' => null,
    'as' => 'button',
    'href' => null,
    'size' => 'default',
    'chevron' => null,
])

@php
    $tag = in_array($as, ['button', 'a', 'div'], true) ? $as : 'button';

    // Derive initials from the name when none are supplied (first letters of the first two words).
    $fallback = $initials ?: (string) \Illuminate\Support\Str::of((string) $name)
        ->explode(' ')->filter()->take(2)
        ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');

    $avatarSize = $size === 'sm' ? 'size-7' : 'size-8';
    $showChevron = $chevron ?? ($tag === 'button');
@endphp

<{{ $tag }}
    data-slot="profile"
    @if ($tag === 'button') type="button" @endif
    @if ($tag === 'a' && $href) href="{{ $href }}" @endif
    {{ $attributes->twMerge('group flex w-full items-center gap-2 rounded-md p-1 text-start text-foreground outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50') }}
>
    <x-ui.avatar :class="$avatarSize.' shrink-0'">
        @if ($avatar)
            <x-ui.avatar-image :src="$avatar" :alt="$name ?? ''" />
        @endif
        <x-ui.avatar-fallback>{{ $fallback }}</x-ui.avatar-fallback>
    </x-ui.avatar>

    @if ($name || $description)
        <span class="flex min-w-0 flex-1 flex-col">
            @if ($name)
                <span class="truncate text-sm font-medium leading-tight">{{ $name }}</span>
            @endif
            @if ($description)
                <span class="text-muted-foreground truncate text-xs leading-tight">{{ $description }}</span>
            @endif
        </span>
    @endif

    @if ($showChevron)
        <x-lucide-chevrons-up-down class="text-muted-foreground ms-auto size-4 shrink-0" aria-hidden="true" />
    @endif

    {{ $slot }}
</{{ $tag }}>
