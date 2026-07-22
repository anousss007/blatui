{{-- A table loading state. --}}
<div class="w-full max-w-lg overflow-hidden rounded-md border">
    <div class="bg-muted/40 flex items-center gap-4 border-b px-4 py-3">
        <x-ui.skeleton class="h-4 w-24" />
        <x-ui.skeleton class="h-4 w-32" />
        <x-ui.skeleton class="ml-auto h-4 w-16" />
    </div>
    @foreach (range(1, 4) as $i)
        <div class="flex items-center gap-4 px-4 py-3 {{ $i < 4 ? 'border-b' : '' }}">
            <x-ui.skeleton class="size-8 shrink-0 rounded-full" />
            <x-ui.skeleton class="h-4 w-24" />
            <x-ui.skeleton class="h-4 w-32" />
            <x-ui.skeleton class="ml-auto h-4 w-16" />
        </div>
    @endforeach
</div>
