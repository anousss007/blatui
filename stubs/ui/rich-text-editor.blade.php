@props([
    'name' => null,
    'value' => '',
    'placeholder' => 'Write something…',
    'id' => null,
])

@php
    // execCommand is deprecated but remains universally supported across every browser
    // and is the standard dependency-free way to build a WYSIWYG. The toolbar maps each
    // button to a command; `block` actions use formatBlock (H1/H2/paragraph).
    $editorId = $id ?: 'rte-' . \Illuminate\Support\Str::random(8);
    $labelId = $editorId . '-label';

    // Toolbar definition. `cmd` runs execCommand; `block` runs formatBlock with a tag;
    // `link` and `clear` are special-cased in the Alpine handlers. `state` is the
    // queryCommandState key used to reflect aria-pressed (null = not a toggle).
    $tools = [
        ['key' => 'bold',          'icon' => 'bold',           'label' => 'Bold',          'cmd' => 'bold',          'state' => 'bold'],
        ['key' => 'italic',        'icon' => 'italic',         'label' => 'Italic',        'cmd' => 'italic',        'state' => 'italic'],
        ['key' => 'underline',     'icon' => 'underline',      'label' => 'Underline',     'cmd' => 'underline',     'state' => 'underline'],
        ['key' => 'strike',        'icon' => 'strikethrough',  'label' => 'Strikethrough', 'cmd' => 'strikeThrough', 'state' => 'strikeThrough'],
        ['sep' => true],
        ['key' => 'h1',            'icon' => 'heading-1',      'label' => 'Heading 1',     'block' => 'h1',          'state' => null],
        ['key' => 'h2',            'icon' => 'heading-2',      'label' => 'Heading 2',     'block' => 'h2',          'state' => null],
        ['sep' => true],
        ['key' => 'ul',            'icon' => 'list',           'label' => 'Bullet list',   'cmd' => 'insertUnorderedList', 'state' => 'insertUnorderedList'],
        ['key' => 'ol',            'icon' => 'list-ordered',   'label' => 'Numbered list', 'cmd' => 'insertOrderedList',   'state' => 'insertOrderedList'],
        ['sep' => true],
        ['key' => 'link',          'icon' => 'link',           'label' => 'Insert link',   'link' => true,           'state' => null],
        ['key' => 'clear',         'icon' => 'remove-formatting', 'label' => 'Clear formatting', 'clear' => true,    'state' => null],
    ];
@endphp

<div
    data-slot="rich-text-editor"
    x-data="{
        active: {},
        sync() {
            if (this.$refs.input) this.$refs.input.value = this.$refs.editor.innerHTML;
        },
        run(cmd) {
            this.$refs.editor.focus();
            document.execCommand(cmd, false, null);
            this.refresh();
            this.sync();
        },
        block(tag) {
            this.$refs.editor.focus();
            document.execCommand('formatBlock', false, tag);
            this.refresh();
            this.sync();
        },
        link() {
            this.$refs.editor.focus();
            const url = window.prompt('Link URL');
            if (url) document.execCommand('createLink', false, url);
            this.refresh();
            this.sync();
        },
        clear() {
            this.$refs.editor.focus();
            document.execCommand('removeFormat', false, null);
            document.execCommand('unlink', false, null);
            this.refresh();
            this.sync();
        },
        refresh() {
            // Only reflect state when the selection is inside this editor.
            const sel = window.getSelection();
            if (!sel || !sel.rangeCount || !this.$refs.editor.contains(sel.anchorNode)) return;
            const next = {};
            for (const k of @js(collect($tools)->whereNotNull('state')->pluck('state')->values())) {
                try { next[k] = document.queryCommandState(k); } catch (e) { next[k] = false; }
            }
            this.active = next;
        },
        init() {
            this.sync();
            this._onSel = () => this.refresh();
            document.addEventListener('selectionchange', this._onSel);
        },
        destroy() {
            document.removeEventListener('selectionchange', this._onSel);
        },
    }"
    {{ $attributes->twMerge('border-input bg-background focus-within:border-ring focus-within:ring-ring/50 w-full overflow-hidden rounded-md border shadow-xs transition-[color,box-shadow] focus-within:ring-[3px]') }}
>
    <div
        role="toolbar"
        aria-label="Formatting"
        data-slot="rich-text-editor-toolbar"
        class="bg-muted/40 flex flex-wrap items-center gap-0.5 border-b p-1"
    >
        @foreach ($tools as $tool)
            @if (isset($tool['sep']))
                <span aria-hidden="true" class="bg-border mx-1 h-5 w-px self-center"></span>
            @else
                <button
                    type="button"
                    data-slot="rich-text-editor-button"
                    aria-label="{{ $tool['label'] }}"
                    @if (! empty($tool['state'])) :aria-pressed="!!active['{{ $tool['state'] }}']" @endif
                    @if (isset($tool['cmd']))
                        @click="run(@js($tool['cmd']))"
                    @elseif (isset($tool['block']))
                        @click="block(@js($tool['block']))"
                    @elseif (isset($tool['link']))
                        @click="link()"
                    @elseif (isset($tool['clear']))
                        @click="clear()"
                    @endif
                    @class([
                        'text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-8 cursor-pointer items-center justify-center rounded-md outline-none transition-colors focus-visible:ring-[3px]',
                        'aria-pressed:bg-accent aria-pressed:text-accent-foreground' => ! empty($tool['state']),
                    ])
                >
                    <x-dynamic-component :component="'lucide-'.$tool['icon']" class="size-4" aria-hidden="true" />
                </button>
            @endif
        @endforeach
    </div>

    <div
        x-ref="editor"
        data-slot="rich-text-editor-content"
        contenteditable="true"
        role="textbox"
        aria-multiline="true"
        aria-labelledby="{{ $labelId }}"
        id="{{ $editorId }}"
        data-placeholder="{{ $placeholder }}"
        dir="auto"
        @input="sync()"
        @keyup="refresh()"
        @mouseup="refresh()"
        @focus="refresh()"
        class="min-h-40 w-full max-w-none px-3 py-3 text-sm leading-7 outline-none empty:before:text-muted-foreground empty:before:pointer-events-none empty:before:content-[attr(data-placeholder)] [&_a]:text-primary [&_a]:underline [&_a]:underline-offset-4 [&_h1]:mb-2 [&_h1]:text-2xl [&_h1]:font-semibold [&_h2]:mb-2 [&_h2]:text-xl [&_h2]:font-semibold [&_li]:mt-1 [&_ol]:my-2 [&_ol]:list-decimal [&_ol]:ps-6 [&_p]:my-2 [&_ul]:my-2 [&_ul]:list-disc [&_ul]:ps-6"
    >{!! $value !!}</div>

    {{-- Accessible name for the textbox; visually hidden (it duplicates the placeholder intent). --}}
    <span id="{{ $labelId }}" class="sr-only">{{ $placeholder }}</span>

    @if ($name)
        <textarea x-ref="input" name="{{ $name }}" class="hidden" aria-hidden="true" tabindex="-1">{!! $value !!}</textarea>
    @endif
</div>
