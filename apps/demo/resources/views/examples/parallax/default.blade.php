{{--
    Reacts to PAGE scroll. The tall frame below gives the effect room to read:
    scroll the page and the background image drifts at a different speed than the
    foreground card, creating depth.
--}}
<div class="space-y-6">
    <p class="text-muted-foreground text-sm">
        Scroll the page — the photo drifts slower than the text card in front of it.
    </p>

    <div class="relative h-[28rem] overflow-hidden rounded-xl border">
        {{-- Background layer: parallaxes (lags) behind the foreground. --}}
        <x-ui.parallax :speed="0.4" class="absolute inset-0">
            <img
                src="https://picsum.photos/seed/blatui-parallax/1200/900"
                alt="Mountain landscape"
                class="h-[34rem] w-full object-cover"
            />
        </x-ui.parallax>

        {{-- Foreground content sits in front, scrolling with the page (no parallax). --}}
        <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/70 via-black/20 to-transparent p-8">
            <div class="space-y-2 text-white">
                <h3 class="text-2xl font-semibold">Depth on scroll</h3>
                <p class="max-w-md text-sm text-white/80">
                    The image moves at a fraction of the scroll speed, so it appears to
                    sit further away than the caption resting on top of it.
                </p>
            </div>
        </div>
    </div>
</div>
