@props([
    'title',
    'href' => null,
    'image',
    'imageAlt' => '',
    'price' => null,
    'compareAt' => null,
    'currency' => '$',
    'badge' => null,
    'category' => null,
    'rating' => null,
    'reviews' => null,
    'wishlist' => false,
])

@php
    // Fall back to the title for the image alt so the image is never unlabelled.
    $alt = $imageAlt !== '' ? $imageAlt : $title;

    // Pick a conventional badge tone from the label: discounts read as danger,
    // freshness as success, everything else stays neutral. All use the `solid`
    // intensity so the text meets AA against the filled background.
    $badgeKey = \Illuminate\Support\Str::lower((string) $badge);
    $badgeTone = match (true) {
        str_contains($badgeKey, 'sale'), str_contains($badgeKey, 'off'), str_contains($badgeKey, '%') => 'danger',
        str_contains($badgeKey, 'new') => 'success',
        default => 'neutral',
    };
    // Opaque, theme-stable fills with white text — the solid destructive/success
    // tokens are too light in dark mode for AA against white, and this badge sits
    // over a photo (needs an opaque background, not a translucent tint).
    $badgeOverride = match ($badgeTone) {
        'danger' => 'bg-red-700 text-white border-transparent',
        'success' => 'bg-emerald-700 text-white border-transparent',
        default => '',
    };
@endphp

<div
    data-slot="product-card"
    {{ $attributes->twMerge('group bg-card text-card-foreground flex flex-col overflow-hidden rounded-xl border shadow-sm') }}
>
    {{-- Image area --}}
    <div class="bg-muted relative aspect-square overflow-hidden">
        <img
            src="{{ $image }}"
            alt="{{ $alt }}"
            loading="lazy"
            class="size-full rounded-t-xl object-cover transition-transform duration-300 group-hover:scale-105"
        />

        @if ($badge)
            <div class="absolute start-2 top-2">
                <x-ui.badge :tone="$badgeTone" variant="solid" class="{{ $badgeOverride }}">{{ $badge }}</x-ui.badge>
            </div>
        @endif

        @if ($wishlist)
            <button
                type="button"
                x-data="{ active: false }"
                @click="active = !active"
                :aria-pressed="active.toString()"
                aria-label="Add to wishlist"
                class="bg-background/80 text-foreground hover:bg-background absolute end-2 top-2 inline-flex size-8 cursor-pointer items-center justify-center rounded-full border shadow-sm backdrop-blur transition-colors outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]"
            >
                <x-lucide-heart class="size-4 transition-colors" x-bind:class="active ? 'fill-red-500 text-red-500' : 'fill-none'" aria-hidden="true" />
            </button>
        @endif
    </div>

    {{-- Body --}}
    <div class="flex flex-1 flex-col gap-2 p-4">
        @if ($category)
            <p class="text-muted-foreground text-xs">{{ $category }}</p>
        @endif

        <h3 class="text-sm leading-snug font-medium">
            @if ($href)
                <a href="{{ $href }}" class="rounded-sm outline-none hover:underline focus-visible:ring-ring/50 focus-visible:ring-[3px]">{{ $title }}</a>
            @else
                {{ $title }}
            @endif
        </h3>

        @if ($rating !== null)
            <div class="flex items-center gap-2 text-sm">
                <x-ui.rating :value="$rating" readonly size="sm" :name="'Rated '.$rating.' out of 5'" />
                @if ($reviews !== null)
                    <span class="text-muted-foreground">({{ $reviews }})</span>
                @endif
            </div>
        @endif

        @if ($price !== null)
            <div class="mt-auto pt-1">
                <x-ui.price :amount="$price" :compareAt="$compareAt" :currency="$currency" size="lg" />
            </div>
        @endif

        {{-- Action: a custom slot, or the default add-to-cart fallback. --}}
        <div class="mt-3">
            @if (trim($slot) !== '')
                {{ $slot }}
            @else
                <x-ui.button class="w-full">
                    <x-lucide-shopping-cart aria-hidden="true" /> Add to cart
                </x-ui.button>
            @endif
        </div>
    </div>
</div>
