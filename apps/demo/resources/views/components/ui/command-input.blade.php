@props(['placeholder' => 'Type a command or search...'])

<div data-slot="command-input-wrapper" class="flex h-9 items-center gap-2 border-b px-3">
    <x-lucide-search class="size-4 shrink-0 opacity-50" />
    <input
        x-model="query"
        data-slot="command-input"
        placeholder="{{ $placeholder }}"
        {{ $attributes->twMerge('placeholder:text-muted-foreground flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-hidden disabled:cursor-not-allowed disabled:opacity-50') }}
    >
</div>
