@props(['type' => 'text'])

<input
    type="{{ $type }}"
    data-slot="input-group-control"
    {{ $attributes->twMerge('flex-1 w-full min-w-0 rounded-none border-0 bg-transparent px-3 py-1 text-base shadow-none outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50 md:text-sm') }}
>
