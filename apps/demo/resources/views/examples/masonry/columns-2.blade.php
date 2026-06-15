<x-ui.masonry class="w-full max-w-md" :columns="2" gap="4">
    @php
        // Plain muted blocks with varying heights — no images, just the layout rhythm.
        $blocks = [
            ['h' => 'h-28', 'label' => 'One'],
            ['h' => 'h-44', 'label' => 'Two'],
            ['h' => 'h-36', 'label' => 'Three'],
            ['h' => 'h-24', 'label' => 'Four'],
            ['h' => 'h-40', 'label' => 'Five'],
            ['h' => 'h-32', 'label' => 'Six'],
        ];
    @endphp

    @foreach ($blocks as $block)
        <div @class(['bg-muted text-muted-foreground flex items-center justify-center rounded-xl border text-sm font-medium', $block['h']])>
            {{ $block['label'] }}
        </div>
    @endforeach
</x-ui.masonry>
