<th data-slot="table-head" @unless ($attributes->has('scope')) scope="col" @endunless {{ $attributes->twMerge('text-foreground h-10 px-2 text-start align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pe-0 [&>[role=checkbox]]:translate-y-[2px]') }}>
    {{ $slot }}
</th>
