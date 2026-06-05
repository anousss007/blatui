<x-ui.carousel orientation="vertical" class="w-full max-w-xs">
    <x-ui.carousel-content class="h-[240px]">
        @foreach (range(1, 5) as $i)
            <x-ui.carousel-item class="h-full">
                <div class="h-full p-1">
                    <x-ui.card class="h-full">
                        <x-ui.card-content class="flex h-full items-center justify-center p-6">
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
