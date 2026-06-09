{{-- Full-bleed image with the title and text overlaid on a gradient scrim. --}}
<x-ui.card class="relative w-full max-w-sm overflow-hidden p-0">
    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80&auto=format&fit=crop"
        alt="Snowy mountain peaks rising above the clouds at sunset"
        class="aspect-[4/3] w-full object-cover" />
    <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/25 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 space-y-1.5 p-5 text-white">
        <x-ui.badge class="border-white/30 bg-white/15 text-white backdrop-blur-sm">Travel</x-ui.badge>
        <h3 class="text-lg font-semibold tracking-tight">Exploring the mountains</h3>
        <p class="text-sm text-white/80">A short trip above the clouds, where the air is thin and the views endless.</p>
    </div>
</x-ui.card>
