<x-ui.carousel class="w-full max-w-xs">
    <x-ui.carousel-content>
        @foreach (range(1, 5) as $i)
            <x-ui.carousel-item>
                <div class="p-1">
                    <x-ui.card>
                        <x-ui.card-content class="flex aspect-square items-center justify-center p-6">
                            <span class="text-4xl font-semibold">{{ $i }}</span>
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </x-ui.carousel-item>
        @endforeach
    </x-ui.carousel-content>
    <x-ui.carousel-previous />
    <x-ui.carousel-next />
</x-ui.carousel>
