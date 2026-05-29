@php
    $dir = resource_path('views/examples/'.$slug);
    $examples = collect(glob($dir.'/*.blade.php'))
        ->map(fn ($p) => basename($p, '.blade.php'))
        ->sort(function ($a, $b) {
            if ($a === 'default') return -1;
            if ($b === 'default') return 1;
            return strcmp($a, $b);
        })
        ->values();

    $title = \Illuminate\Support\Str::headline($slug);
    $description = config('docs.descriptions.'.$slug);
@endphp

<x-layouts.docs :active="$slug" :title="$title" :description="($description ?? null) ? $description.' A Laravel Blade component you copy, paste and own.' : $title.' component for Laravel Blade — copy, paste and own the code.'">
    <div class="space-y-2">
        <p class="text-muted-foreground text-sm font-medium">Components</p>
        <h1 class="text-3xl font-bold tracking-tight">{{ $title }}</h1>
        @if ($description)
            <p class="text-muted-foreground text-lg">{{ $description }}</p>
        @endif
    </div>

    <div class="bg-muted/40 mt-6 flex items-center gap-2 rounded-lg border px-3 py-2 font-mono text-sm"
        x-data="{ copied: false, copy() { navigator.clipboard.writeText('php artisan blatui:add {{ $slug }}'); this.copied = true; setTimeout(() => this.copied = false, 1500); } }">
        <x-lucide-terminal class="text-muted-foreground size-4 shrink-0" />
        <span class="flex-1 truncate">php artisan blatui:add {{ $slug }}</span>
        <button type="button" @click="copy()" class="text-muted-foreground hover:text-foreground shrink-0">
            <x-lucide-copy class="size-4" x-show="!copied" />
            <x-lucide-check class="size-4 text-emerald-500" x-show="copied" x-cloak />
        </button>
    </div>

    @forelse ($examples as $ex)
        <section class="mt-10">
            @unless ($ex === 'default')
                <h2 class="mb-1 text-xl font-semibold tracking-tight">{{ \Illuminate\Support\Str::headline($ex) }}</h2>
            @endunless
            <x-preview :file="$slug.'.'.$ex" />
        </section>
    @empty
        <p class="text-muted-foreground mt-10">No examples yet.</p>
    @endforelse
</x-layouts.docs>
