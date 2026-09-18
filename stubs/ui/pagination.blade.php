<nav
    role="navigation"
    aria-label="{{ __('Pagination') }}"
    data-slot="pagination"
    {{ $attributes->twMerge('mx-auto flex w-full justify-center') }}
>
    {{ $slot }}
</nav>
