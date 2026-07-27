@props([
    'label' => null,        // accessible name; defaults via __() below (no hardcoded English)
])

@php
    // i18n-safe default: this is a translation key, localise it in your lang files.
    $label ??= __('Toggle Sidebar');
@endphp

<button
    type="button"
    @click="toggle()"
    data-slot="sidebar-trigger"
    aria-label="{{ $label }}"
    :aria-expanded="isMobile ? openMobile : open"
    {{ $attributes->twMerge('hover:bg-accent hover:text-accent-foreground inline-flex size-7 items-center justify-center rounded-md transition-colors outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]') }}
>
    <x-lucide-panel-left class="size-4 rtl:rotate-180" aria-hidden="true" />
    <span class="sr-only">{{ $label }}</span>
</button>
