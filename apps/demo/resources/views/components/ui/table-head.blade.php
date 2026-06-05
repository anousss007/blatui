<th data-slot="table-head" @unless ($attributes->has('scope')) scope="col" @endunless {{ $attributes->twMerge('text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]') }}>
    {{ $slot }}
</th>
