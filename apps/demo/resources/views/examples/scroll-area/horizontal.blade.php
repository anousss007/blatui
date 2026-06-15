<x-ui.scroll-area class="w-full max-w-sm rounded-md border whitespace-nowrap">
    <div class="flex w-max gap-4 p-4">
        @foreach (range(1, 10) as $i)
            <figure class="shrink-0">
                <div class="bg-muted flex size-32 items-center justify-center rounded-md text-2xl font-semibold">{{ $i }}</div>
                <figcaption class="text-muted-foreground pt-2 text-xs">Artwork {{ $i }}</figcaption>
            </figure>
        @endforeach
    </div>
</x-ui.scroll-area>
