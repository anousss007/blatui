@props([
    'name' => null,
    'multiple' => false,
    'accept' => null,
    'maxSizeLabel' => null,
    'id' => null,
    'disabled' => false,
])

@php
    // A stable id so the dropzone region can reference the hidden <input> for assistive tech.
    $fieldId = $id ?: 'file-upload-' . \Illuminate\Support\Str::random(6);
    // Default hint line — accepted types and/or a max-size label, when provided.
    $hintBits = array_filter([
        $accept ? trim($accept) : null,
        $maxSizeLabel,
    ]);
    $hint = $hintBits ? implode(' · ', $hintBits) : null;
@endphp

<div
    data-slot="file-upload"
    x-data="{
        files: [],
        dragging: false,
        disabled: @js((bool) $disabled),
        formatBytes(bytes) {
            if (!bytes) return '0 B';
            const units = ['B', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            return parseFloat((bytes / Math.pow(1024, i)).toFixed(i ? 1 : 0)) + ' ' + units[i];
        },
        addFiles(fileList) {
            if (this.disabled || !fileList) return;
            Array.from(fileList).forEach((file) => {
                const entry = {
                    name: file.name,
                    size: file.size,
                    type: file.type,
                    url: file.type && file.type.startsWith('image/') ? URL.createObjectURL(file) : null,
                    progress: 0,
                };
                this.files.push(entry);
                this.simulate(entry);
            });
        },
        simulate(entry) {
            // Demo-only faux upload so the per-file progress bar animates 0 -> 100%.
            const timer = setInterval(() => {
                entry.progress = Math.min(100, entry.progress + Math.random() * 18 + 4);
                if (entry.progress >= 100) {
                    entry.progress = 100;
                    clearInterval(timer);
                }
            }, 250);
        },
        remove(index) {
            const entry = this.files[index];
            if (entry && entry.url) URL.revokeObjectURL(entry.url);
            this.files.splice(index, 1);
        },
        onChange(event) {
            this.addFiles(event.target.files);
        },
        onDrop(event) {
            this.dragging = false;
            if (this.disabled) return;
            this.addFiles(event.dataTransfer.files);
        },
        open() {
            if (this.disabled) return;
            this.$refs.input.click();
        },
        destroy() {
            this.files.forEach((f) => f.url && URL.revokeObjectURL(f.url));
        },
    }"
    {{ $attributes->twMerge('flex w-full flex-col gap-3') }}
>
    {{-- The real field — visually hidden, but it carries name/accept/multiple so a <form> receives the files. --}}
    <input
        x-ref="input"
        type="file"
        id="{{ $fieldId }}"
        @if ($name) name="{{ $name }}{{ $multiple ? '[]' : '' }}" @endif
        @if ($accept) accept="{{ $accept }}" @endif
        @if ($multiple) multiple @endif
        @if ($disabled) disabled @endif
        @change="onChange($event)"
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
        aria-label="{{ $multiple ? 'Upload files — drag and drop, or activate to browse' : 'Upload a file — drag and drop, or activate to browse' }}"
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
            Drag &amp; drop files here, or click to browse
        </p>
        @if ($hint)
            <p class="text-muted-foreground text-xs">{{ $hint }}</p>
        @endif
    </div>

    {{-- The Alpine list is the visual layer mirroring the selected files. --}}
    <ul x-show="files.length" x-cloak class="flex flex-col gap-2" role="list">
        <template x-for="(file, index) in files" :key="index">
            <li
                data-slot="file-upload-item"
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
                    {{-- Per-file progress bar — width binds to the file's progress value. --}}
                    <div
                        class="bg-muted h-1.5 w-full overflow-hidden rounded-full"
                        role="progressbar"
                        aria-label="Upload progress"
                        :aria-valuenow="Math.round(file.progress)"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div class="bg-primary h-full rounded-full transition-[width] duration-200" :style="`width: ${file.progress}%`"></div>
                    </div>
                </div>

                <button
                    type="button"
                    @click="remove(index)"
                    :aria-label="`Remove ${file.name}`"
                    class="text-muted-foreground hover:text-foreground hover:bg-muted focus-visible:ring-ring/50 flex size-8 shrink-0 items-center justify-center rounded-md outline-none transition-colors focus-visible:ring-[3px]"
                >
                    <x-lucide-x class="size-4" aria-hidden="true" />
                </button>
            </li>
        </template>
    </ul>
</div>
