@props([
    'id' => null,
    'name' => null,
    'value' => 'on',
    'checked' => false,
    'disabled' => false,
])

<button
    type="button"
    role="switch"
    @if ($id) id="{{ $id }}" @endif
    x-data="{ checked: @js((bool) $checked) }"
    x-init="$watch('checked', v => $refs.input.checked = v)"
    :data-state="checked ? 'checked' : 'unchecked'"
    :aria-checked="checked"
    @click="checked = !checked"
    @if ($disabled) disabled @endif
    data-slot="switch"
    {{ $attributes->twMerge('peer data-[state=checked]:bg-primary data-[state=unchecked]:bg-input focus-visible:border-ring focus-visible:ring-ring/50 dark:data-[state=unchecked]:bg-input/80 inline-flex h-[1.15rem] w-8 shrink-0 items-center rounded-full border border-transparent shadow-xs transition-all outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50') }}
>
    <span
        data-slot="switch-thumb"
        :data-state="checked ? 'checked' : 'unchecked'"
        class="bg-background dark:data-[state=unchecked]:bg-foreground dark:data-[state=checked]:bg-primary-foreground pointer-events-none block size-4 rounded-full ring-0 transition-transform data-[state=checked]:translate-x-[calc(100%-2px)] data-[state=unchecked]:translate-x-0"
    ></span>
    <input
        type="checkbox"
        x-ref="input"
        tabindex="-1"
        aria-hidden="true"
        class="sr-only"
        @if ($name) name="{{ $name }}" @endif
        value="{{ $value }}"
        @checked($checked)
        @disabled($disabled)
    />
</button>
