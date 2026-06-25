{{--
    Brand — your app's logo/wordmark, optionally linked. (Parity with Flux's <flux:brand>.)
      name   the wordmark text shown beside the logo
      href   link target (default "/"); pass :href="null" to render a plain <div>
      logo   logo image URL; or pass an inline SVG/icon via the default slot
      alt    accessible text for the logo image (defaults to the name)
--}}
@props([
    'name' => null,
    'href' => '/',
    'logo' => null,
    'alt' => null,
])

@php
    $tag = ($href === null || $href === false) ? 'div' : 'a';
    $hasLogoSlot = $slot->isNotEmpty();
@endphp

<{{ $tag }}
    data-slot="brand"
    @if ($tag === 'a') href="{{ $href }}" @endif
    @unless ($name) aria-label="{{ $alt ?? __('Home') }}" @endunless
    {{ $attributes->twMerge('inline-flex items-center gap-2 rounded-md font-semibold text-foreground outline-none [&_img]:size-6 [&_svg]:size-6 [&_svg]:shrink-0 focus-visible:ring-ring/50 focus-visible:ring-[3px]') }}
>
    @if ($logo)
        <img src="{{ $logo }}" alt="{{ $alt ?? $name ?? '' }}" class="size-6 shrink-0 rounded" />
    @elseif ($hasLogoSlot)
        {{ $slot }}
    @endif

    @if ($name)
        <span>{{ $name }}</span>
    @endif
</{{ $tag }}>
