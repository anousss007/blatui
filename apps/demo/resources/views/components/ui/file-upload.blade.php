@props([
    'name' => null,
    'multiple' => false,
    'accept' => null,
    'maxSizeLabel' => null,
    'value' => null,
    'id' => null,
    'disabled' => false,
])

@php
    // The <input> carries an id only when the consumer asked for one — never a generated one.
    // Livewire's morph keys an element by wire:id, then wire:key, then plain id, so an id that
    // is re-rolled on every render makes the old and new input look like different elements:
    // morphdom swaps the node instead of patching it. Livewire drives uploads FROM this input
    // and dispatches livewire-upload-finish on the node it captured, so a swap mid-upload fires
    // that event at a node already off the document — the bar reaches 100% and stays there for
    // good. With no id at all both sides key on "", the input is patched, and the upload it is
    // running survives every re-render. Issue #27; the generated id it replaces was referenced
    // by nothing anyway.
    // Default hint line — accepted types and/or a max-size label, when provided.
    $hintBits = array_filter([
        $accept ? trim($accept) : null,
        $maxSizeLabel,
    ]);
    $hint = $hintBits ? implode(' · ', $hintBits) : null;

    // What the field ALREADY holds — the file saved against the record being edited, which the
    // component has no other way of knowing about: wire:model carries the upload in progress,
    // never the one that finished three days ago. Accepts a URL, a list of URLs, or maps with
    // name/size/image, and each one becomes an ordinary row: same thumbnail, same remove button.
    // Without this an edit form has to rebuild that row by hand, outside the component. #29
    $given = is_array($value)
        ? (array_key_exists('url', $value) ? [$value] : $value)
        : (($value === null || $value === '') ? [] : [$value]);

    $initial = [];
    foreach ($given as $item) {
        $item = is_array($item) ? $item : ['url' => $item];
        $url = trim((string) ($item['url'] ?? ''));
        if ($url === '') {
            continue;
        }
        $path = parse_url($url, PHP_URL_PATH) ?: $url;
        $initial[] = [
            'url' => $url,
            'name' => (string) ($item['name'] ?? (basename($path) ?: $url)),
            'size' => isset($item['size']) ? (int) $item['size'] : null,
            // Whether to draw it as a thumbnail. Guessed from the extension, because a URL is
            // all we are given; pass 'image' in the map to say so outright.
            'image' => (bool) ($item['image'] ?? preg_match('/\.(avif|gif|jpe?g|png|svg|webp)(\?|#|$)/i', $url)),
        ];
    }

    // Livewire bridge — a consumer's wire:model rides on the real <input type=file>, which is
    // Livewire's upload target: it uploads the selection itself and reports what is actually
    // happening by dispatching livewire-upload-{start,progress,finish,error,cancel} from that
    // input. Those events are what drives the progress bar below. The property name travels as
    // a data attribute too, so removing a row can withdraw the upload server-side — and so the
    // effect below can READ the property and follow it back down when the server clears it.
    // Inert without Livewire: an empty bag renders nothing and this is a plain form field.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    $wireAttrs = $attributes->whereStartsWith('wire:model');
    $attributes = $attributes->whereDoesntStartWith('wire:model');
    if ($hasWire) { $attributes = $attributes->merge(['data-blat-model' => $wireModel->value()]); }
    // Read off the attribute rather than baked into x-data, which Alpine evaluates exactly once:
    // a modal reused for a second record renders a different value, and the list has to follow.
    if ($initial) { $attributes = $attributes->merge(['data-blat-value' => json_encode($initial, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)]); }
@endphp

<div
    data-slot="file-upload"
    x-data="{
        files: [],
        dragging: false,
        seq: 0,
        disabled: @js((bool) $disabled),
        multiple: @js((bool) $multiple),

        // The bound property, read through the same bridge every other value-bearing component
        // uses. Nothing is written through it — withdraw() still talks to $wire directly — but
        // reading it inside an effect subscribes that effect to it, which is the whole point:
        // the server clearing the property is a fact this component had no way of hearing.
        _model: $blatModel(null),

        // The data-blat-value we last seeded the existing rows from, so a re-render that hands
        // over the same value does not rebuild rows the user may have removed since.
        seedKey: null,

        // Is anything actually going to upload these? Read back off the input rather than
        // remembered, for the same reason the bound property is: a morph can add or remove the
        // wire:model, and a bar that animates for an upload nobody started is the bug this
        // component shipped with.
        //
        // $root, not $el: Alpine binds the magics to whichever element is evaluating, so inside
        // a method reached from a row button `$el` is that button, not the component.
        get uploads() {
            return this.$root.hasAttribute('data-blat-model')
                && [...this.$refs.input.attributes].some((a) => a.name.startsWith('wire:model'));
        },
        get pending() { return this.files.filter((f) => f.status === 'uploading'); },

        formatBytes(bytes) {
            if (!bytes) return '0 B';
            const units = ['B', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            return parseFloat((bytes / Math.pow(1024, i)).toFixed(i ? 1 : 0)) + ' ' + units[i];
        },

        addFiles(fileList) {
            if (this.disabled || !fileList || !fileList.length) return;
            const batch = Array.from(fileList).map((file) => ({
                id: ++this.seq,
                file,
                name: file.name,
                size: file.size,
                type: file.type,
                image: !!(file.type && file.type.startsWith('image/')),
                url: file.type && file.type.startsWith('image/') ? URL.createObjectURL(file) : null,
                // Only a URL this component minted may be revoked; an existing file's URL
                // belongs to the page and has to outlive the row.
                blob: !!(file.type && file.type.startsWith('image/')),
                progress: 0,
                // Nothing is in flight when there is no upload target — the file is simply
                // selected, and will travel with the surrounding <form>.
                status: this.uploads ? 'uploading' : 'ready',
                error: null,
                tmp: null,
                existing: false,
            }));
            // A single-file field holds one selection: the new pick replaces the old one, the
            // way the native input it wraps does.
            if (this.multiple) this.files.push(...batch);
            else { this.clearAll(); this.files = batch; }
        },

        // ---- real upload state, straight from Livewire ----
        onProgress(event) {
            const p = Math.min(100, Math.max(0, Number(event.detail?.progress) || 0));
            this.pending.forEach((entry) => { entry.progress = p; });
        },
        onFinish() {
            // The property now holds the temporary filename(s) Livewire stored, in upload order.
            // They arrive tagged (`livewire-file:foo.png`); $removeUpload matches on the bare
            // filename, so the tag comes off here rather than at every call site.
            const stored = this.$blatWire?.$get(this.$root.dataset.blatModel);
            const names = Array.isArray(stored) ? stored.slice(-this.pending.length) : [stored];
            this.pending.forEach((entry, i) => {
                entry.progress = 100;
                entry.status = 'ready';
                entry.tmp = typeof names[i] === 'string' ? names[i].replace(/^livewire-files?:/, '') : null;
            });
        },
        onError() {
            this.pending.forEach((entry) => {
                entry.status = 'error';
                entry.error = @js(__('Upload failed'));
            });
        },
        onCancel() {
            this.files = this.files.filter((entry) => entry.status !== 'uploading');
        },

        remove(index) {
            const entry = this.files[index];
            if (!entry) return;
            if (entry.blob) URL.revokeObjectURL(entry.url);
            this.files.splice(index, 1);
            if (entry.existing) this.announce(entry);
            else this.withdraw(entry);
        },

        // A file that was already saved when the page rendered is not this component's to
        // delete: there is no temporary upload to withdraw and nothing on the native input.
        // Saying it went is the most it can do — the record the file hangs off is the
        // consumer's. Dispatched from $root so it still bubbles once the row is gone.
        announce(entry) {
            this.$root.dispatchEvent(new CustomEvent('file-remove', {
                bubbles: true,
                detail: { url: entry.url, name: entry.name },
            }));
        },

        // Removing a row has to remove the file, not just its row: server-side it is already
        // stored as a temporary upload, and in a plain form the native input still carries it.
        withdraw(entry) {
            const wire = this.$blatWire;
            const property = this.$root.dataset.blatModel;
            if (wire && property && entry.status !== 'uploading') {
                if (this.multiple && entry.tmp) wire.$removeUpload(property, entry.tmp);
                else if (!this.multiple) wire.$set(property, null);
            }
            this.syncInput();
        },
        clearAll() {
            this.files.forEach((entry) => {
                if (entry.existing) this.announce(entry);
                if (entry.blob) URL.revokeObjectURL(entry.url);
            });
            this.files = [];
        },
        // Keep the native input's FileList equal to what the list shows, so a <form> submits
        // exactly the files the user can still see.
        syncInput() {
            if (this.uploads) return; // Livewire owns the input's value while it uploads.
            const dt = new DataTransfer();
            this.files.forEach((entry) => entry.file && dt.items.add(entry.file));
            this.$refs.input.files = dt.files;
        },

        // ---- what the SERVER says this field holds ----
        // Reading the property here is what subscribes the x-effect below to it. The work is
        // deferred to a microtask so that writing `files` is not itself a dependency of the
        // effect doing the writing.
        sync() {
            const held = this._model.value;
            const seed = this.$root.dataset.blatValue || '';
            queueMicrotask(() => this.reconcile(seed, held));
        },

        reconcile(seed, held) {
            if (seed !== this.seedKey) { this.seedKey = seed; this.hydrate(seed); }
            if (!this.uploads) return;

            // The temporary uploads the property still names. Livewire tags them
            // (`livewire-file:foo.png`); rows remember the bare filename, so the tag comes off.
            const list = Array.isArray(held) ? held : (held === null || held === undefined ? [] : [held]);
            const names = list
                .map((v) => (typeof v === 'string' ? v.replace(/^livewire-files?:/, '') : null))
                .filter(Boolean);
            const empty = !list.length || (list.length === 1 && list[0] === '');

            // Anything else in there — a stored path the consumer swapped in, say — is not ours
            // to interpret, and a row is better kept than wrongly dropped.
            if (!empty && !names.length) return;

            // A finished upload the property no longer names is a file the server has let go:
            // the form was reset, or the modal reopened for the next record. Since #27 this
            // component is patched rather than replaced, so nothing else would clear the row.
            // Rows still uploading, rows that failed, and existing files are all left alone.
            this.files = this.files.filter((entry) => {
                if (entry.existing || entry.status !== 'ready' || entry.tmp === null) return true;
                if (names.includes(entry.tmp)) return true;
                if (entry.blob) URL.revokeObjectURL(entry.url);
                return false;
            });
        },

        // Rebuild the rows for the already-saved files. What the user picked in this session is
        // theirs and stays; only the server-rendered half is replaced.
        hydrate(seed) {
            let items = [];
            try { items = seed ? JSON.parse(seed) : []; } catch (e) { items = []; }
            this.files = this.files.filter((entry) => !entry.existing);
            this.files.unshift(...items.map((item) => ({
                id: ++this.seq,
                file: null,
                name: item.name,
                size: item.size,
                type: null,
                image: !!item.image,
                url: item.url,
                blob: false,
                progress: 100,
                status: 'ready',
                error: null,
                tmp: null,
                existing: true,
            })));
        },

        onChange(event) {
            this.addFiles(event.target.files);
        },
        onDrop(event) {
            this.dragging = false;
            if (this.disabled) return;
            // Hand the drop to the real input and let it announce itself. A dropped file that
            // never reaches the input is a file that never uploads and never submits — it only
            // looks selected.
            const dropped = Array.from(event.dataTransfer.files);
            if (!dropped.length) return;
            const dt = new DataTransfer();
            (this.multiple ? dropped : dropped.slice(0, 1)).forEach((file) => dt.items.add(file));
            this.$refs.input.files = dt.files;
            this.$refs.input.dispatchEvent(new Event('change', { bubbles: true }));
        },
        open() {
            if (this.disabled) return;
            this.$refs.input.click();
        },
        destroy() {
            this.files.forEach((f) => f.blob && URL.revokeObjectURL(f.url));
        },
    }"
    {{-- Seeds the existing rows, and follows the bound property when the server clears it. --}}
    x-effect="sync()"
    {{-- Livewire's own upload events, bubbling up from the <input> it drives. Spelled x-on:
         rather than @, because Blade reads `@livewire-…` as the @livewire directive. --}}
    x-on:livewire-upload-progress="onProgress($event)"
    x-on:livewire-upload-finish="onFinish()"
    x-on:livewire-upload-error="onError()"
    x-on:livewire-upload-cancel="onCancel()"
    {{ $attributes->twMerge('flex w-full flex-col gap-3') }}
>
    {{-- The real field — visually hidden, but it carries name/accept/multiple so a <form> receives the files. --}}
    <input
        x-ref="input"
        type="file"
        @if ($id) id="{{ $id }}" @endif
        @if ($name) name="{{ $name }}{{ $multiple ? '[]' : '' }}" @endif
        @if ($accept) accept="{{ $accept }}" @endif
        @if ($multiple) multiple @endif
        @if ($disabled) disabled @endif
        @change="onChange($event)"
        {{ $wireAttrs }}
        class="sr-only"
        tabindex="-1"
        aria-hidden="true"
    />

    {{-- Focusable dropzone. role=button + Enter/Space + click all open the native picker. --}}
    <div
        data-slot="file-upload-dropzone"
        role="button"
        :tabindex="disabled ? -1 : 0"
        :aria-disabled="disabled"
        aria-label="{{ $multiple ? __('Upload files — drag and drop, or activate to browse') : __('Upload a file — drag and drop, or activate to browse') }}"
        @click="open()"
        @keydown.enter.prevent="open()"
        @keydown.space.prevent="open()"
        @dragover.prevent="!disabled && (dragging = true)"
        @dragleave.prevent="dragging = false"
        @drop.prevent="onDrop($event)"
        :class="dragging ? 'bg-muted ring-ring/50 ring-[3px] border-ring' : ''"
        class="border-input flex cursor-pointer flex-col items-center justify-center gap-2 rounded-lg border border-dashed bg-transparent px-6 py-8 text-center transition-[color,background-color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-disabled:pointer-events-none aria-disabled:opacity-50"
    >
        <span class="bg-muted text-muted-foreground flex size-10 items-center justify-center rounded-full">
            <x-lucide-cloud-upload class="size-5" aria-hidden="true" />
        </span>
        <p class="text-foreground text-sm font-medium">
            {{ __('Drag & drop files here, or click to browse') }}
        </p>
        @if ($hint)
            <p class="text-muted-foreground text-xs">{{ $hint }}</p>
        @endif
    </div>

    {{-- The Alpine list is the visual layer mirroring the selected files. --}}
    <ul x-show="files.length" x-cloak class="flex flex-col gap-2" role="list">
        <template x-for="(file, index) in files" :key="file.id">
            <li
                data-slot="file-upload-item"
                :data-status="file.status"
                :data-existing="file.existing || null"
                class="bg-card flex items-center gap-3 rounded-lg border p-2.5 shadow-xs"
            >
                {{-- Thumbnail for images, generic icon otherwise. --}}
                <template x-if="file.url && file.image">
                    <img :src="file.url" :alt="file.name" class="size-10 shrink-0 rounded-md object-cover" />
                </template>
                <template x-if="!(file.url && file.image)">
                    <span class="bg-muted text-muted-foreground flex size-10 shrink-0 items-center justify-center rounded-md">
                        <x-lucide-file class="size-5" aria-hidden="true" />
                    </span>
                </template>

                <div class="flex min-w-0 flex-1 flex-col gap-1">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-foreground truncate text-sm font-medium" x-text="file.name"></span>
                        {{-- An already-saved file arrives as a URL; its size is only known if
                             the consumer passed one, and "0 B" would be a lie. --}}
                        <span x-show="file.size" class="text-muted-foreground shrink-0 text-xs tabular-nums" x-text="formatBytes(file.size)"></span>
                    </div>
                    {{-- Per-file progress — the width is Livewire's own upload progress, so the bar
                         only exists when there is an upload for it to report. --}}
                    <template x-if="uploads && !file.existing && file.status !== 'error'">
                        <div
                            class="bg-muted h-1.5 w-full overflow-hidden rounded-full"
                            role="progressbar"
                            aria-label="{{ __('Upload progress') }}"
                            :aria-valuenow="Math.round(file.progress)"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        >
                            <div class="bg-primary h-full rounded-full transition-[width] duration-200" :style="`width: ${file.progress}%`"></div>
                        </div>
                    </template>
                    <template x-if="file.status === 'error'">
                        <p class="text-destructive text-xs" role="alert" x-text="file.error"></p>
                    </template>
                </div>

                <button
                    type="button"
                    @click="remove(index)"
                    :aria-label="`{{ __('Remove') }} ${file.name}`"
                    class="text-muted-foreground hover:text-foreground hover:bg-muted focus-visible:ring-ring/50 flex size-8 shrink-0 items-center justify-center rounded-md outline-none transition-colors focus-visible:ring-[3px]"
                >
                    <x-lucide-x class="size-4" aria-hidden="true" />
                </button>
            </li>
        </template>
    </ul>
</div>
