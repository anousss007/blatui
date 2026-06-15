{{--
    A thin NProgress-style loading bar. In a real app it's fixed to the top of the page;
    here :demo="true" renders it in-flow so you can watch it animate. The Start / Done
    buttons drive the bar through its exposed window events (top-progress:start / :done) —
    the same hook you'd fire from your navigation lifecycle.
--}}
<div x-data class="w-full max-w-md space-y-4">
    <div class="bg-card overflow-hidden rounded-lg border">
        <x-ui.top-progress :demo="true" :height="3" />
        <div class="text-muted-foreground p-4 text-sm">
            The bar above sits in-flow for this preview. In production it is fixed to the
            very top of the viewport.
        </div>
    </div>

    <div class="flex gap-2">
        <x-ui.button size="sm" x-on:click="$dispatch('top-progress:start')">Start</x-ui.button>
        <x-ui.button size="sm" variant="outline" x-on:click="$dispatch('top-progress:done')">Done</x-ui.button>
    </div>
</div>
