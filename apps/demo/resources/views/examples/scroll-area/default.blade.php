<x-ui.scroll-area class="h-72 w-48 rounded-md border">
    <div class="p-4">
        <h4 class="mb-4 text-sm leading-none font-medium">Tags</h4>
        @foreach (range(1, 20) as $i)
            <div class="text-sm">v1.2.0-beta.{{ $i }}</div>
            @if ($i < 20)
                <x-ui.separator class="my-2" />
            @endif
        @endforeach
    </div>
</x-ui.scroll-area>
