<div class="flex w-full max-w-sm flex-col gap-4">
    @foreach (range(1, 3) as $i)
        <div class="flex items-center gap-4">
            <x-ui.skeleton class="size-10 rounded-full" />
            <div class="flex flex-1 flex-col gap-2">
                <x-ui.skeleton class="h-4 w-1/2" />
                <x-ui.skeleton class="h-3 w-3/4" />
            </div>
        </div>
    @endforeach
</div>
