@props([
    'href' => '#',
    'label' => null,        // visible text; defaults via __() below (no hardcoded English)
    'ariaLabel' => null,    // accessible name; defaults via __() below
])

@php
    // i18n-safe defaults: these are translation keys, localise them in your lang files.
    $label ??= __('Previous');
    $ariaLabel ??= __('Go to previous page');
@endphp

<x-ui.pagination-link
    :href="$href"
    size="default"
    :aria-label="$ariaLabel"
    {{ $attributes->twMerge('gap-1 px-2.5 sm:ps-2.5') }}
>
    <x-lucide-chevron-left class="rtl:rotate-180" />
    <span class="hidden sm:block">{{ $label }}</span>
</x-ui.pagination-link>
