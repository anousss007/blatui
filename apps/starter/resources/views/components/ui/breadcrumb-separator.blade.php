<li
    data-slot="breadcrumb-separator"
    role="presentation"
    aria-hidden="true"
    {{ $attributes->twMerge('[&>svg]:size-3.5') }}
>
    @if (trim($slot) !== '')
        {{ $slot }}
    @else
        <x-lucide-chevron-right />
    @endif
</li>
