{{-- The full set of common aspect ratios, landscape through portrait. --}}
<div class="grid w-full max-w-3xl grid-cols-2 items-start gap-4 sm:grid-cols-4">
    @foreach (['1 / 1', '4 / 3', '3 / 2', '16 / 9', '21 / 9', '3 / 4', '9 / 16'] as $r)
        <div>
            <x-ui.aspect-ratio ratio="{{ $r }}" class="bg-muted rounded-lg">
                <div class="text-muted-foreground flex size-full items-center justify-center text-sm">{{ str_replace(' ', '', $r) }}</div>
            </x-ui.aspect-ratio>
        </div>
    @endforeach
</div>
