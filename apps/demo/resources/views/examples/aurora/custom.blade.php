<x-ui.aurora
    :colors="['#f97316', '#ef4444', '#ec4899', '#f59e0b']"
    :blur="80"
    :speed="18"
    class="w-full max-w-xl"
>
    <div class="flex flex-col items-center gap-3 py-12 text-center">
        <h2 class="text-3xl font-semibold tracking-tight text-balance sm:text-4xl">
            A warmer sky
        </h2>
        <p class="max-w-md text-balance text-white/80">
            Bring your own palette with <code class="rounded bg-white/15 px-1.5 py-0.5 text-sm">:colors</code>,
            then dial the <code class="rounded bg-white/15 px-1.5 py-0.5 text-sm">blur</code> and
            <code class="rounded bg-white/15 px-1.5 py-0.5 text-sm">speed</code>.
        </p>
    </div>
</x-ui.aurora>
