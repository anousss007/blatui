@props([
    'name' => null,
    'multiple' => false,
    'accept' => null,
    'maxSizeLabel' => null,
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

    // Livewire bridge — a consumer's wire:model rides on the real <input type=file>, which is
    // Livewire's upload target: it uploads the selection itself and reports what is actually
    // happening by dispatching livewire-upload-{start,progress,finish,error,cancel} from that
    // input. Those events are what drives the progress bar below. The property name travels as
    // a data attribute too, so removing a row can withdraw the upload server-side.
    // Inert without Livewire: an empty bag renders nothing and this is a plain form field.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    $wireAttrs = $attributes->whereStartsWith('wire:model');
    $attributes = $attributes->whereDoesntStartWith('wire:model');
    if ($hasWire) { $attributes = $attributes->merge(['data-blat-model' => $wireModel->value()]); }
@endphp

<div
    data-slot="file-upload"
    x-data="{
        files: [],
        dragging: false,
        seq: 0,
        disabled: @js((bool) $disabled),
        multiple: @js((bool) $multiple),

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
                url: file.type && file.type.startsWith('image/') ? URL.createObjectURL(file) : null,
                progress: 0,
                // Nothing is in flight when there is no upload target — the file is simply
                // selected, and will travel with the surrounding <form>.
                status: this.uploads ? 'uploading' : 'ready',
                error: null,
                tmp: null,
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
            if (entry.url) URL.revokeObjectURL(entry.url);
            this.files.splice(index, 1);
            this.withdraw(entry);
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
            this.files.forEach((entry) => entry.url && URL.revokeObjectURL(entry.url));
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
            this.files.forEach((f) => f.url && URL.revokeObjectURL(f.url));
        },
    }"
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
                class="bg-card flex items-center gap-3 rounded-lg border p-2.5 shadow-xs"
            >
                {{-- Thumbnail for images, generic icon otherwise. --}}
                <template x-if="file.url">
                    <img :src="file.url" :alt="file.name" class="size-10 shrink-0 rounded-md object-cover" />
                </template>
                <template x-if="!file.url">
                    <span class="bg-muted text-muted-foreground flex size-10 shrink-0 items-center justify-center rounded-md">
                        <x-lucide-file class="size-5" aria-hidden="true" />
                    </span>
                </template>

                <div class="flex min-w-0 flex-1 flex-col gap-1">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-foreground truncate text-sm font-medium" x-text="file.name"></span>
                        <span class="text-muted-foreground shrink-0 text-xs tabular-nums" x-text="formatBytes(file.size)"></span>
                    </div>
                    {{-- Per-file progress — the width is Livewire's own upload progress, so the bar
                         only exists when there is an upload for it to report. --}}
                    <template x-if="uploads && file.status !== 'error'">
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
