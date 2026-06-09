{{--
    Quote — a styled blockquote / testimonial with an optional attribution.
      author   name of the person quoted
      role     their title / company
      avatar   URL of their photo
      cite     URL the quote is sourced from (sets <blockquote cite>)
    Semantics: <figure> + <blockquote> + <figcaption>, so it's accessible and printable.
--}}
@props([
    'author' => null,
    'role' => null,
    'avatar' => null,
    'cite' => null,
])

<figure data-slot="quote" {{ $attributes->twMerge('text-foreground relative max-w-2xl') }}>
    <svg class="text-muted-foreground/25 mb-3 size-8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
        <path d="M9.5 4C6.46 4 4 6.46 4 9.5c0 3.04 2.46 5.5 5.5 5.5.17 0 .33-.01.5-.03V15c0 2.21-1.79 4-4 4a1 1 0 1 0 0 2c3.31 0 6-2.69 6-6V9.5C12 6.46 9.54 4 9.5 4Zm10 0C16.46 4 14 6.46 14 9.5c0 3.04 2.46 5.5 5.5 5.5.17 0 .33-.01.5-.03V15c0 2.21-1.79 4-4 4a1 1 0 1 0 0 2c3.31 0 6-2.69 6-6V9.5C22 6.46 19.54 4 19.5 4Z" />
    </svg>

    <blockquote @if ($cite) cite="{{ $cite }}" @endif class="text-lg leading-relaxed font-medium text-balance sm:text-xl">
        {{ $slot }}
    </blockquote>

    @if ($author || $role || $avatar)
        <figcaption class="mt-5 flex items-center gap-3">
            @if ($avatar)
                <img src="{{ $avatar }}" alt="{{ $author }}" loading="lazy" class="size-10 shrink-0 rounded-full object-cover" />
            @endif
            <div class="text-sm">
                @if ($author)<div class="font-semibold">{{ $author }}</div>@endif
                @if ($role)<div class="text-muted-foreground">{{ $role }}</div>@endif
            </div>
        </figcaption>
    @endif
</figure>
