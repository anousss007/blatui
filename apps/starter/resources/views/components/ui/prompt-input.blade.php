@props([
    'name' => null,
    'placeholder' => 'Send a message…',
    'attachable' => false,
    'disabled' => false,
    'id' => null,
    'rows' => 1,
    'maxRows' => 6,
])

@php
    // The TEXTAREA is the labelled control, so route an author-supplied aria-label onto it
    // (fallback "Message"). Pull it off the root attribute bag so it doesn't also land on the
    // wrapper div, which would create a duplicate/competing name.
    $textareaLabel = $attributes->get('aria-label') ?: 'Message';
    $attributes = $attributes->except('aria-label');
@endphp

<div
    data-slot="prompt-input"
    x-data="{
        value: '',
        disabled: @js((bool) $disabled),
        maxRows: @js((int) $maxRows),
        get empty() { return this.value.trim().length === 0; },
        resize(el) {
            // Reset so the field can shrink as well as grow.
            el.style.height = 'auto';
            let target = el.scrollHeight;
            const cs = getComputedStyle(el);
            let lh = parseFloat(cs.lineHeight);
            if (isNaN(lh)) lh = parseFloat(cs.fontSize) * 1.2;
            const pad = parseFloat(cs.paddingTop) + parseFloat(cs.paddingBottom);
            const border = parseFloat(cs.borderTopWidth) + parseFloat(cs.borderBottomWidth);
            const cap = (lh * this.maxRows) + pad + border;
            if (target > cap) {
                target = cap;
                el.style.overflowY = 'auto';
            } else {
                el.style.overflowY = 'hidden';
            }
            el.style.height = target + 'px';
        },
        submit() {
            if (this.disabled || this.empty) return;
            // If wrapped in a <form>, submit it; otherwise dispatch a bubbling 'submit' event
            // carrying the trimmed value so a listener on the component can react.
            const form = this.$root.closest('form');
            if (form) {
                form.requestSubmit ? form.requestSubmit() : form.submit();
            } else {
                this.$root.dispatchEvent(new CustomEvent('submit', {
                    detail: { value: this.value },
                    bubbles: true,
                }));
            }
        },
    }"
    {{ $attributes->twMerge('border-input focus-within:border-ring focus-within:ring-ring/50 dark:bg-input/30 bg-background flex w-full flex-col gap-2 rounded-xl border p-2 shadow-xs transition-[color,box-shadow] focus-within:ring-[3px]') }}
>
    <textarea
        data-slot="prompt-input-textarea"
        x-model="value"
        x-init="$nextTick(() => resize($el))"
        @input="resize($el)"
        @keydown.enter="if ($event.metaKey || $event.ctrlKey) { $event.preventDefault(); submit(); }"
        rows="{{ (int) $rows }}"
        aria-label="{{ $textareaLabel }}"
        placeholder="{{ $placeholder }}"
        @if ($name) name="{{ $name }}" @endif
        @if ($id) id="{{ $id }}" @endif
        @disabled($disabled)
        class="placeholder:text-muted-foreground text-foreground flex w-full resize-none overflow-hidden bg-transparent px-2 pt-1 text-base outline-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
    ></textarea>

    <div data-slot="prompt-input-toolbar" class="flex items-center gap-2">
        @if ($attachable)
            <button
                type="button"
                aria-label="Attach file"
                @disabled($disabled)
                class="text-muted-foreground hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring/50 inline-flex size-8 shrink-0 items-center justify-center rounded-lg outline-none transition-colors focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50"
            >
                <x-lucide-paperclip class="size-4" aria-hidden="true" />
            </button>
        @endif

        <div class="flex-1"></div>

        <span data-slot="prompt-input-hint" class="text-muted-foreground hidden text-xs select-none sm:inline" aria-hidden="true">
            <kbd class="font-sans">⌘↵</kbd> to send
        </span>

        <button
            type="button"
            aria-label="Send"
            @click="submit()"
            :disabled="disabled || empty"
            class="bg-primary text-primary-foreground hover:bg-primary/90 focus-visible:ring-ring/50 inline-flex size-8 shrink-0 items-center justify-center rounded-full shadow-xs outline-none transition-all focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50"
        >
            <x-lucide-arrow-up class="size-4" aria-hidden="true" />
        </button>
    </div>
</div>
