<x-ui.marquee fade class="w-full max-w-xl py-2">
    @foreach (['Acme', 'Globex', 'Initech', 'Umbrella', 'Soylent', 'Hooli', 'Stark'] as $name)
        <span class="text-muted-foreground text-lg font-semibold whitespace-nowrap">{{ $name }}</span>
    @endforeach
</x-ui.marquee>
