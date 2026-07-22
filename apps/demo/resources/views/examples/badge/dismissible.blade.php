{{-- Removable badges with a close button. --}}
<div class="flex flex-wrap items-center gap-2">
    @foreach (['Design', 'Engineering', 'Marketing'] as $tag)
        <x-ui.badge x-data="{ show: true }" x-show="show" variant="secondary" class="gap-1 pr-1">
            {{ $tag }}
            <button type="button" @click="show = false" aria-label="Remove {{ $tag }}" class="hover:bg-foreground/10 -my-px ml-0.5 inline-flex size-3.5 items-center justify-center rounded-full transition-colors">
                <x-lucide-x class="size-3" />
            </button>
        </x-ui.badge>
    @endforeach
</div>
