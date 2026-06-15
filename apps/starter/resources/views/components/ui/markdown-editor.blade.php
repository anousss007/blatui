{{--
    Markdown Editor — a textarea with a live HTML preview.

      name         optional form field name for the underlying <textarea>
      value        initial markdown (seeds the editor)
      placeholder  textarea placeholder (default "Write markdown…")
      rows         textarea rows (default 8)
      id           optional id; a generated one is used for the textarea label otherwise

    A bordered container holds: a toolbar (bold / italic / code / link / ul / ol / quote)
    that wraps or prepends markdown around the current selection, a Write / Preview tab
    switch, the Write panel (a monospace <textarea>) and the Preview panel (rendered HTML).

    Markdown is rendered entirely client-side by a small renderer registered as an Alpine
    component (see the @once <script> below). HTML is ESCAPED first, then a safe subset of
    markdown is applied — so user input can never inject markup. The engine lives in a
    <script> (not an x-data attribute) so HTML-entity strings like &#39; aren't corrupted by
    attribute decoding. Supported subset: headings (#/##/###), bold (**), italic (*), inline
    code (`), fenced code blocks (```), links [text](url) — only http/https/mailto/relative,
    unordered (-/*) and ordered (1.) lists, blockquotes (>), and line breaks.

    A11y: the Write / Preview tabs are real role="tab" controls in a role="tablist" with
    aria-selected; their panels are role="tabpanel". The textarea carries an accessible
    name via aria-label. Toolbar buttons have aria-labels. All controls have focus rings.
    The layout is logical-property / RTL-safe.
--}}
@props([
    'name' => null,
    'value' => '',
    'placeholder' => 'Write markdown…',
    'rows' => 8,
    'id' => null,
])

@php
    $uid = $id ?: 'blat-md-'.\Illuminate\Support\Str::random(6);
    $textareaId = $uid.'-textarea';
@endphp

@once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blatMarkdownEditor', (initial = '') => ({
                source: initial,
                view: 'write',
                get html() { return this.render(this.source); },

                // ---- Selection-aware insertion helpers (toolbar) ----
                get textarea() { return this.$refs.textarea; },

                wrap(before, after = before) {
                    const ta = this.textarea;
                    const start = ta.selectionStart;
                    const end = ta.selectionEnd;
                    const sel = this.source.slice(start, end);
                    this.source = this.source.slice(0, start) + before + sel + after + this.source.slice(end);
                    this.$nextTick(() => {
                        ta.focus();
                        ta.setSelectionRange(start + before.length, start + before.length + sel.length);
                    });
                },

                prefixLines(make) {
                    const ta = this.textarea;
                    const start = ta.selectionStart;
                    const end = ta.selectionEnd;
                    const lineStart = this.source.lastIndexOf('\n', start - 1) + 1;
                    let lineEnd = this.source.indexOf('\n', end);
                    if (lineEnd === -1) lineEnd = this.source.length;
                    const block = this.source.slice(lineStart, lineEnd) || '';
                    const out = block.split('\n').map((l, i) => make(l, i)).join('\n');
                    this.source = this.source.slice(0, lineStart) + out + this.source.slice(lineEnd);
                    this.$nextTick(() => {
                        ta.focus();
                        ta.setSelectionRange(lineStart, lineStart + out.length);
                    });
                },

                insertLink() {
                    const ta = this.textarea;
                    const start = ta.selectionStart;
                    const end = ta.selectionEnd;
                    const sel = this.source.slice(start, end) || 'text';
                    const snippet = '[' + sel + '](url)';
                    this.source = this.source.slice(0, start) + snippet + this.source.slice(end);
                    this.$nextTick(() => {
                        ta.focus();
                        const urlAt = start + sel.length + 3;
                        ta.setSelectionRange(urlAt, urlAt + 3);
                    });
                },

                bold() { this.wrap('**'); },
                italic() { this.wrap('*'); },
                code() { this.wrap('`'); },
                ul() { this.prefixLines(l => l.startsWith('- ') ? l : '- ' + l); },
                ol() { let n = 0; this.prefixLines(l => (++n) + '. ' + l.replace(/^\d+\.\s+/, '')); },
                quote() { this.prefixLines(l => l.startsWith('> ') ? l : '> ' + l); },

                // ---- Inline markdown→HTML renderer (safe subset) ----
                escape(str) {
                    return str
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#39;');
                },

                safeUrl(url) {
                    const u = (url || '').trim();
                    if (/^(https?:\/\/|mailto:|\/|#|\.\/|\.\.\/)/i.test(u)) return u;
                    if (/^[a-z][a-z0-9+.-]*:/i.test(u)) return '#';
                    return u;
                },

                inline(text) {
                    let out = text;
                    out = out.replace(/`([^`]+)`/g, (m, c) =>
                        '<code class="bg-muted relative rounded px-[0.3rem] py-[0.2rem] font-mono text-[0.85em] font-medium">' + c + '</code>');
                    out = out.replace(/\[([^\]]+)\]\(([^)\s]+)\)/g, (m, t, u) => {
                        const href = this.safeUrl(u.replace(/&amp;/g, '&')).replace(/&/g, '&amp;');
                        return '<a href="' + href + '" class="text-primary font-medium underline underline-offset-4" rel="noopener noreferrer nofollow">' + t + '</a>';
                    });
                    out = out.replace(/\*\*([^*]+)\*\*/g, '<strong class="font-semibold">$1</strong>');
                    out = out.replace(/(^|[^*])\*([^*\n]+)\*/g, '$1<em class="italic">$2</em>');
                    return out;
                },

                render(src) {
                    const raw = (src ?? '').replace(/\r\n?/g, '\n');
                    const lines = this.escape(raw).split('\n');
                    const html = [];
                    let i = 0;
                    let listType = null;
                    const closeList = () => { if (listType) { html.push('</' + listType + '>'); listType = null; } };

                    while (i < lines.length) {
                        let line = lines[i];

                        if (/^```/.test(line.trim())) {
                            closeList();
                            const buf = [];
                            i++;
                            while (i < lines.length && !/^```/.test(lines[i].trim())) { buf.push(lines[i]); i++; }
                            i++;
                            html.push('<pre class="bg-muted my-3 overflow-x-auto rounded-md p-3 text-sm"><code class="font-mono">' + buf.join('\n') + '</code></pre>');
                            continue;
                        }

                        let m;
                        if ((m = line.match(/^###\s+(.*)$/))) { closeList(); html.push('<h3 class="mt-4 mb-2 text-lg font-semibold tracking-tight">' + this.inline(m[1]) + '</h3>'); i++; continue; }
                        if ((m = line.match(/^##\s+(.*)$/)))  { closeList(); html.push('<h2 class="mt-5 mb-2 text-xl font-semibold tracking-tight">' + this.inline(m[1]) + '</h2>'); i++; continue; }
                        if ((m = line.match(/^#\s+(.*)$/)))   { closeList(); html.push('<h1 class="mt-6 mb-3 text-2xl font-bold tracking-tight first:mt-0">' + this.inline(m[1]) + '</h1>'); i++; continue; }

                        if (/^&gt;\s?/.test(line)) {
                            closeList();
                            const buf = [];
                            while (i < lines.length && /^&gt;\s?/.test(lines[i])) { buf.push(this.inline(lines[i].replace(/^&gt;\s?/, ''))); i++; }
                            html.push('<blockquote class="text-muted-foreground my-3 border-s-2 ps-4 italic">' + buf.join('<br>') + '</blockquote>');
                            continue;
                        }

                        if ((m = line.match(/^[-*]\s+(.*)$/))) {
                            if (listType !== 'ul') { closeList(); html.push('<ul class="my-3 ms-6 list-disc space-y-1">'); listType = 'ul'; }
                            html.push('<li>' + this.inline(m[1]) + '</li>'); i++; continue;
                        }

                        if ((m = line.match(/^\d+\.\s+(.*)$/))) {
                            if (listType !== 'ol') { closeList(); html.push('<ol class="my-3 ms-6 list-decimal space-y-1">'); listType = 'ol'; }
                            html.push('<li>' + this.inline(m[1]) + '</li>'); i++; continue;
                        }

                        if (line.trim() === '') { closeList(); i++; continue; }

                        closeList();
                        const buf = [];
                        while (
                            i < lines.length &&
                            lines[i].trim() !== '' &&
                            !/^```/.test(lines[i].trim()) &&
                            !/^#{1,3}\s+/.test(lines[i]) &&
                            !/^&gt;\s?/.test(lines[i]) &&
                            !/^[-*]\s+/.test(lines[i]) &&
                            !/^\d+\.\s+/.test(lines[i])
                        ) { buf.push(this.inline(lines[i])); i++; }
                        html.push('<p class="my-2 leading-7">' + buf.join('<br>') + '</p>');
                    }

                    closeList();
                    return html.join('') || '<p class="text-muted-foreground italic">Nothing to preview yet.</p>';
                },
            }));
        });
    </script>
@endonce

<div
    data-slot="markdown-editor"
    x-data="blatMarkdownEditor(@js((string) $value))"
    {{ $attributes->twMerge('border-input bg-background flex w-full flex-col overflow-hidden rounded-md border shadow-xs') }}
>
    {{-- Toolbar + tab switch --}}
    <div class="bg-muted/40 flex flex-wrap items-center gap-1 border-b p-1.5">
        {{-- Formatting tools --}}
        <div class="flex items-center gap-0.5" role="group" aria-label="Formatting">
            <button type="button" aria-label="Bold" @click="bold()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-bold class="size-4" aria-hidden="true" />
            </button>
            <button type="button" aria-label="Italic" @click="italic()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-italic class="size-4" aria-hidden="true" />
            </button>
            <button type="button" aria-label="Inline code" @click="code()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-code class="size-4" aria-hidden="true" />
            </button>
            <button type="button" aria-label="Insert link" @click="insertLink()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-link class="size-4" aria-hidden="true" />
            </button>
            <span class="bg-border mx-0.5 h-5 w-px" aria-hidden="true"></span>
            <button type="button" aria-label="Bulleted list" @click="ul()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-list class="size-4" aria-hidden="true" />
            </button>
            <button type="button" aria-label="Numbered list" @click="ol()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-list-ordered class="size-4" aria-hidden="true" />
            </button>
            <button type="button" aria-label="Blockquote" @click="quote()" class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-7 items-center justify-center rounded-sm outline-none transition-colors focus-visible:ring-[3px]">
                <x-lucide-quote class="size-4" aria-hidden="true" />
            </button>
        </div>

        {{-- Write / Preview tabs --}}
        <div role="tablist" aria-label="Editor view" class="bg-muted text-muted-foreground ms-auto inline-flex h-8 items-center justify-center rounded-md p-0.5">
            <button
                type="button"
                role="tab"
                :aria-selected="view === 'write'"
                :tabindex="view === 'write' ? 0 : -1"
                aria-controls="{{ $uid }}-panel-write"
                id="{{ $uid }}-tab-write"
                @click="view = 'write'"
                @keydown.arrow-right.prevent="view = 'preview'; $nextTick(() => $refs.tabPreview.focus())"
                @keydown.arrow-left.prevent="view = 'write'; $nextTick(() => $refs.tabWrite.focus())"
                x-ref="tabWrite"
                class="focus-visible:ring-ring/50 inline-flex h-7 items-center justify-center rounded-sm px-3 text-sm font-medium outline-none transition-all focus-visible:ring-[3px]"
                :class="view === 'write' ? 'bg-background text-foreground shadow-xs' : 'hover:text-foreground'"
            >
                Write
            </button>
            <button
                type="button"
                role="tab"
                :aria-selected="view === 'preview'"
                :tabindex="view === 'preview' ? 0 : -1"
                aria-controls="{{ $uid }}-panel-preview"
                id="{{ $uid }}-tab-preview"
                @click="view = 'preview'"
                @keydown.arrow-right.prevent="view = 'preview'; $nextTick(() => $refs.tabPreview.focus())"
                @keydown.arrow-left.prevent="view = 'write'; $nextTick(() => $refs.tabWrite.focus())"
                x-ref="tabPreview"
                class="focus-visible:ring-ring/50 inline-flex h-7 items-center justify-center rounded-sm px-3 text-sm font-medium outline-none transition-all focus-visible:ring-[3px]"
                :class="view === 'preview' ? 'bg-background text-foreground shadow-xs' : 'hover:text-foreground'"
            >
                Preview
            </button>
        </div>
    </div>

    {{-- Write panel --}}
    <div role="tabpanel" id="{{ $uid }}-panel-write" aria-labelledby="{{ $uid }}-tab-write" x-show="view === 'write'">
        <label for="{{ $textareaId }}" class="sr-only">Markdown source</label>
        <textarea
            x-ref="textarea"
            x-model="source"
            id="{{ $textareaId }}"
            @if ($name) name="{{ $name }}" @endif
            rows="{{ (int) $rows }}"
            placeholder="{{ $placeholder }}"
            aria-label="Markdown source"
            class="placeholder:text-muted-foreground focus-visible:ring-ring/50 block w-full resize-y border-0 bg-transparent px-3 py-2.5 font-mono text-sm leading-6 outline-none focus-visible:ring-2 focus-visible:ring-inset"
        ></textarea>
    </div>

    {{-- Preview panel --}}
    <div
        role="tabpanel"
        id="{{ $uid }}-panel-preview"
        aria-labelledby="{{ $uid }}-tab-preview"
        x-show="view === 'preview'"
        x-cloak
        class="text-foreground min-h-32 px-4 py-3 text-sm break-words [&_ol]:my-3 [&_pre]:my-3 [&_ul]:my-3"
        x-html="html"
    ></div>
</div>
