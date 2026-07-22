@props([
    'mask' => '',          // 9 = digit, a = letter, * = alphanumeric; anything else is a literal (e.g. "99/99", "(999) 999-9999")
    'value' => '',
    'id' => null,
    'name' => null,
    'placeholder' => null,
    'inputmode' => null,   // e.g. "numeric" for digit-only masks
])

@php
    // Mirror x-ui.input's default styling so a masked input looks identical.
    $classes = "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive md:text-sm";
@endphp

{{-- A plain <input> (not <x-ui.input>) so the Alpine expression — which contains `<` —
     is never parsed as a Blade component attribute (that would break the component tag). --}}
<input
    type="text"
    data-slot="input"
    data-mask="{{ $mask }}"
    value="{{ $value }}"
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($placeholder) placeholder="{{ $placeholder }}" @endif
    @if ($inputmode) inputmode="{{ $inputmode }}" @endif
    x-data="{
        apply() {
            const mask = this.$el.dataset.mask;
            if (!mask) return;
            const v = this.$el.value;
            let out = '', vi = 0;
            for (let mi = 0; mi < mask.length; mi++) {
                if (vi >= v.length) break;
                const m = mask[mi];
                if (m === '9' || m === 'a' || m === '*') {
                    let ok = false;
                    while (vi < v.length) {
                        const c = v[vi++];
                        const good = m === '9' ? /[0-9]/.test(c) : m === 'a' ? /[a-z]/i.test(c) : /[a-z0-9]/i.test(c);
                        if (good) { out += c; ok = true; break; }
                    }
                    if (!ok) break;
                } else {
                    out += m;
                    if (vi < v.length && v[vi] === m) vi++;
                }
            }
            this.$el.value = out;
        },
    }"
    x-init="apply()"
    x-on:input="apply()"
    {{ $attributes->twMerge($classes) }}
/>
