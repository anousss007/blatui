{{--
    Reacts to PAGE scroll. Two parallax layers at different speeds plus a static
    foreground build a sense of depth — back drifts most, mid less, label is fixed.
--}}
<div class="space-y-6">
    <p class="text-muted-foreground text-sm">
        Scroll the page — each layer moves at its own speed, the label stays put.
    </p>

    <div class="relative h-[26rem] overflow-hidden rounded-xl border bg-muted">
        {{-- Far layer: largest drift (highest speed). --}}
        <x-ui.parallax :speed="0.6" class="absolute inset-0">
            <div class="flex h-[32rem] w-full items-center justify-center">
                <div class="size-72 rounded-full bg-primary/20 blur-2xl"></div>
            </div>
        </x-ui.parallax>

        {{-- Mid layer: smaller drift. --}}
        <x-ui.parallax :speed="0.25" class="absolute inset-0">
            <div class="flex h-[30rem] w-full items-center justify-center">
                <div class="grid grid-cols-3 gap-4">
                    @foreach (range(1, 6) as $i)
                        <div class="size-16 rounded-xl border bg-card shadow-sm"></div>
                    @endforeach
                </div>
            </div>
        </x-ui.parallax>

        {{-- Foreground label: no parallax, scrolls with the page. --}}
        <div class="absolute inset-x-0 bottom-0 p-8">
            <div class="inline-flex items-center gap-2 rounded-full border bg-card px-4 py-2 text-sm font-medium shadow-sm">
                <x-lucide-layers class="size-4 text-primary" aria-hidden="true" />
                Layered parallax
            </div>
        </div>
    </div>
</div>
