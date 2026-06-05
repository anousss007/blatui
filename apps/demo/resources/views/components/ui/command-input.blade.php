@props(['placeholder' => 'Type a command or search...'])

<div data-slot="command-input-wrapper" class="flex h-9 items-center gap-2 border-b px-3">
    <x-lucide-search class="size-4 shrink-0 opacity-50" aria-hidden="true" />
    <input
        x-model="query"
        data-slot="command-input"
        type="text"
        role="combobox"
        aria-expanded="true"
        aria-autocomplete="list"
        autocomplete="off"
        aria-label="{{ $placeholder }}"
        :aria-controls="$id('blat-command-list')"
        :aria-activedescendant="activeId"
        @keydown.down.prevent="move(1)"
        @keydown.up.prevent="move(-1)"
        @keydown.home.prevent="edge('first')"
        @keydown.end.prevent="edge('last')"
        @keydown.enter.prevent="selectActive()"
        placeholder="{{ $placeholder }}"
        {{ $attributes->twMerge('placeholder:text-muted-foreground flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-hidden disabled:cursor-not-allowed disabled:opacity-50') }}
    >
</div>
