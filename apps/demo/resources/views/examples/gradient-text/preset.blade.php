<div class="space-y-2">
    @foreach (['sunset', 'ocean', 'candy'] as $preset)
        <h2 class="text-3xl font-bold tracking-tight">
            <x-ui.gradient-text :preset="$preset" class="capitalize">{{ $preset }}</x-ui.gradient-text>
        </h2>
    @endforeach
</div>
