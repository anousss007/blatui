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

    // Livewire bridge — the editor's HTML binds through $blatModel (blatui-core.js) rather than
    // through a wire:model forwarded onto the mirror <textarea>. The property path travels as a
    // data attribute, so a morph that re-points the component is followed rather than missed, and
    // reading the value inside an effect subscribes that effect to it: that is what lets a value
    // the server assigns repaint an editor the morph is no longer allowed to touch.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) {
        $attributes = $attributes->whereDoesntStartWith('wire:model')->merge(array_filter([
            'data-blat-model' => $wireModel->value(),
            'data-blat-model-live' => $wireModel->hasModifier('live') ? '1' : null,
        ]));
    }
@endphp

<div
    data-slot="rich-text-editor"
    x-data="{
        active: {},
        _model: $blatModel(@js((string) $value)),
        get value() { return this._model.value },
        set value(v) { this._model.value = v },

        // The editor's HTML is the value. It goes to the bound property, and to the mirror
        // <textarea> when there is one, so a plain <form> submits what is on screen.
        sync() {
            const html = this.$refs.editor.innerHTML;
            this.value = html;
            if (this.$refs.input) this.$refs.input.value = html;
        },

        // Repaint from a value that did not come from the keyboard — a server assignment, or a
        // property the component was re-pointed at. Reading `value` is what subscribes the
        // x-effect calling this; the guard is what keeps it from rewriting (and so collapsing
        // the caret in) the very HTML the user just typed.
        repaint(el) {
            const next = this.value ?? '';
            if (next !== el.innerHTML) el.innerHTML = next;
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
            // Seed the <form> mirror, but do NOT write the property: a deferred $set that nothing
            // ever commits leaves the binding marked dirty client-side, and Livewire then holds
            // back every value the server assigns to it for the life of the page. The editor and
            // the property already agree at this point — both are the value that was rendered.
            if (this.$refs.input) this.$refs.input.value = this.$refs.editor.innerHTML;
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
        {{-- The content belongs to the browser once the user starts typing, so the morph is not
             allowed into this subtree: its children are server-rendered, and a re-render would
             otherwise patch them back to the value the page loaded with — silently deleting
             whatever had been written since. `.children` keeps the element itself morphing, so
             only the content is held back. What the server assigns still arrives, through the
             effect below rather than through the morph. --}}
        wire:ignore.children
        x-effect="repaint($el)"
        role="textbox"
        aria-multiline="true"
        {{-- The name is carried on the element rather than by an id pair: an id this component
             generated would be a new morph key on every render, and Livewire would replace the
             box the user is writing in. A consumer's own id is stable, so it still lands. #27 --}}
        aria-label="{{ $placeholder }}"
        @if ($id) id="{{ $id }}" @endif
        data-placeholder="{{ $placeholder }}"
        dir="auto"
        @input="sync()"
        @keyup="refresh()"
        @mouseup="refresh()"
        @focus="refresh()"
        class="min-h-40 w-full max-w-none px-3 py-3 text-sm leading-7 outline-none empty:before:text-muted-foreground empty:before:pointer-events-none empty:before:content-[attr(data-placeholder)] [&_a]:text-primary [&_a]:underline [&_a]:underline-offset-4 [&_h1]:mb-2 [&_h1]:text-2xl [&_h1]:font-semibold [&_h2]:mb-2 [&_h2]:text-xl [&_h2]:font-semibold [&_li]:mt-1 [&_ol]:my-2 [&_ol]:list-decimal [&_ol]:ps-6 [&_p]:my-2 [&_ul]:my-2 [&_ul]:list-disc [&_ul]:ps-6"
    >{!! $value !!}</div>

    {{-- Mirror for a plain <form>: it carries the name and the value, nothing else. The Livewire
         binding no longer rides on it. --}}
    @if ($name)
        <textarea x-ref="input" name="{{ $name }}" class="hidden" aria-hidden="true" tabindex="-1">{!! $value !!}</textarea>
    @endif
</div>
