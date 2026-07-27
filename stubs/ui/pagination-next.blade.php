@props([
    'href' => '#',
    'label' => null,        // visible text; defaults via __() below (no hardcoded English)
    'ariaLabel' => null,    // accessible name; defaults via __() below
])

@php
    // i18n-safe defaults: these are translation keys, localise them in your lang files.
    $label ??= __('Next');
    $ariaLabel ??= __('Go to next page');
@endphp

<x-ui.pagination-link
    :href="$href"
    size="default"
    :aria-label="$ariaLabel"
    {{ $attributes->twMerge('gap-1 px-2.5 sm:pe-2.5') }}
>
    <span class="hidden sm:block">{{ $label }}</span>
    <x-lucide-chevron-right class="rtl:rotate-180" />
</x-ui.pagination-link>
