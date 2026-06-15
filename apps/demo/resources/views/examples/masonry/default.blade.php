<x-ui.masonry class="w-full max-w-2xl" :columns="3" gap="4">
    @php
        // Varying heights are what make a masonry read as a masonry.
        $tiles = [
            ['h' => 'h-40', 'seed' => 'masonry-1'],
            ['h' => 'h-56', 'seed' => 'masonry-2'],
            ['h' => 'h-32', 'seed' => 'masonry-3'],
            ['h' => 'h-48', 'seed' => 'masonry-4'],
            ['h' => 'h-64', 'seed' => 'masonry-5'],
            ['h' => 'h-36', 'seed' => 'masonry-6'],
            ['h' => 'h-52', 'seed' => 'masonry-7'],
            ['h' => 'h-44', 'seed' => 'masonry-8'],
        ];
    @endphp

    @foreach ($tiles as $tile)
        <img
            src="https://picsum.photos/seed/{{ $tile['seed'] }}/400/600"
            alt="Photo {{ $loop->iteration }}"
            loading="lazy"
            @class(['bg-muted w-full rounded-xl border object-cover', $tile['h']])
        />
    @endforeach
</x-ui.masonry>
