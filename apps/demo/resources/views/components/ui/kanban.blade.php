@props([
    // [['id'=>'todo','title'=>'To Do','cards'=>[['id'=>'1','title'=>'…','tags'=>['Bug'],'meta'=>'2d']]]]
    'columns' => [],
])

@php
    // Normalise into a predictable shape so the Alpine state and x-for stay simple.
    $board = collect($columns)->values()->map(function ($col, $ci) {
        return [
            'id' => (string) ($col['id'] ?? 'col-'.$ci),
            'title' => (string) ($col['title'] ?? ''),
            'cards' => collect($col['cards'] ?? [])->values()->map(function ($card, $ki) use ($ci) {
                return [
                    'id' => (string) ($card['id'] ?? "card-{$ci}-{$ki}"),
                    'title' => (string) ($card['title'] ?? ''),
                    'tags' => array_values(array_map('strval', $card['tags'] ?? [])),
                    'meta' => isset($card['meta']) && $card['meta'] !== null ? (string) $card['meta'] : null,
                ];
            })->all(),
        ];
    })->all();

    $hintId = 'kanban-hint-'.\Illuminate\Support\Str::random(6);
@endphp

<div
    data-slot="kanban"
    x-data="{
        columns: @js($board),
        dragId: null,
        fromCol: null,
        overCol: null,
        // Native HTML5 drag is a progressive enhancement only. Begin a drag.
        start(ev, colId, cardId) {
            this.dragId = cardId;
            this.fromCol = colId;
            if (ev.dataTransfer) {
                ev.dataTransfer.effectAllowed = 'move';
                ev.dataTransfer.setData('text/plain', cardId);
            }
        },
        // Move the dragged card into the target column (appended at the end).
        drop(toCol) {
            this.overCol = null;
            if (!this.dragId || this.fromCol === null) return;
            if (this.fromCol === toCol) { this.reset(); return; }
            const src = this.columns.find(c => c.id === this.fromCol);
            const dst = this.columns.find(c => c.id === toCol);
            if (!src || !dst) { this.reset(); return; }
            const idx = src.cards.findIndex(c => c.id === this.dragId);
            if (idx === -1) { this.reset(); return; }
            const [card] = src.cards.splice(idx, 1);
            dst.cards.push(card);
            this.reset();
        },
        reset() { this.dragId = null; this.fromCol = null; this.overCol = null; },
    }"
    {{ $attributes->twMerge('flex w-full gap-4 overflow-x-auto pb-2') }}
    tabindex="0"
    role="group"
    aria-label="Kanban board"
    aria-describedby="{{ $hintId }}"
>
    <p id="{{ $hintId }}" class="sr-only">
        Drag a card with the mouse to move it between columns. Each card is a focusable item within its column.
    </p>

    <template x-for="col in columns" :key="col.id">
        <section
            data-slot="kanban-column"
            class="bg-muted/40 flex min-w-72 shrink-0 flex-col rounded-lg"
            :aria-labelledby="'kbn-' + col.id + '-title'"
            @dragover.prevent="overCol = col.id"
            @dragleave="overCol === col.id && (overCol = null)"
            @drop.prevent="drop(col.id)"
        >
            <header class="flex items-center justify-between gap-2 px-3 py-2.5">
                <h3 :id="'kbn-' + col.id + '-title'" class="text-foreground text-sm font-semibold" x-text="col.title"></h3>
                <span
                    class="bg-muted text-muted-foreground inline-flex h-5 min-w-5 items-center justify-center rounded-full px-1.5 text-xs font-medium tabular-nums"
                    x-text="col.cards.length"
                    aria-hidden="true"
                ></span>
            </header>

            <ul
                class="flex min-h-16 flex-1 flex-col gap-2 rounded-md p-2 transition-colors"
                :class="overCol === col.id ? 'ring-ring/50 ring-2' : ''"
                role="list"
            >
                <template x-for="card in col.cards" :key="card.id">
                    <li
                        data-slot="kanban-card"
                        class="bg-card text-card-foreground border rounded-md p-3 shadow-xs transition-shadow focus-visible:ring-ring/50 focus-visible:ring-[3px] focus-visible:outline-none"
                        :class="dragId === card.id ? 'opacity-50' : 'hover:shadow-sm'"
                        tabindex="0"
                        draggable="true"
                        @dragstart="start($event, col.id, card.id)"
                        @dragend="reset()"
                        :aria-label="card.title + ' — in ' + col.title"
                    >
                        <p class="text-sm font-medium" x-text="card.title"></p>

                        <template x-if="card.tags && card.tags.length">
                            <div class="mt-2 flex flex-wrap gap-1">
                                <template x-for="tag in card.tags" :key="tag">
                                    <span class="bg-secondary text-secondary-foreground inline-flex items-center rounded-md px-1.5 py-0.5 text-[0.625rem] font-medium" x-text="tag"></span>
                                </template>
                            </div>
                        </template>

                        <template x-if="card.meta">
                            <p class="text-muted-foreground mt-2 text-xs" x-text="card.meta"></p>
                        </template>
                    </li>
                </template>
            </ul>
        </section>
    </template>
</div>
