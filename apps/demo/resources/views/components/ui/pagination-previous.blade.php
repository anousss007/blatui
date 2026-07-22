@props(['href' => '#'])

<x-ui.pagination-link
    :href="$href"
    size="default"
    aria-label="Go to previous page"
    {{ $attributes->twMerge('gap-1 px-2.5 sm:pl-2.5') }}
>
    <x-lucide-chevron-left />
    <span class="hidden sm:block">Previous</span>
</x-ui.pagination-link>
