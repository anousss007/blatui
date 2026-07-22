{{-- Several slides visible at once (responsive: 2 on mobile, 3 from md up). --}}
<x-ui.carousel class="w-full max-w-sm">
    <x-ui.carousel-content>
        @foreach (range(1, 8) as $i)
            <x-ui.carousel-item class="basis-1/2 md:basis-1/3">
                <div class="p-1">
                    <x-ui.card variant="sectioned">
                        <x-ui.card-content class="flex aspect-square items-center justify-center p-6">
                            <span class="text-3xl font-semibold">{{ $i }}</span>
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </x-ui.carousel-item>
        @endforeach
    </x-ui.carousel-content>
    <x-ui.carousel-previous />
    <x-ui.carousel-next />
</x-ui.carousel>
