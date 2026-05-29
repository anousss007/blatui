@props([
    'id' => null,
    'name' => null,
    'value' => 'on',
    'checked' => false,
    'disabled' => false,
])

<button
    type="button"
    role="checkbox"
    @if ($id) id="{{ $id }}" @endif
    x-data="{ checked: @js((bool) $checked) }"
    x-init="$watch('checked', v => $refs.input.checked = v)"
    :data-state="checked ? 'checked' : 'unchecked'"
    :aria-checked="checked"
    @click="checked = !checked"
    @if ($disabled) disabled @endif
    data-slot="checkbox"
    {{ $attributes->twMerge('peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground dark:data-[state=checked]:bg-primary data-[state=checked]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 flex items-center justify-center') }}
>
    <span data-slot="checkbox-indicator" class="flex items-center justify-center text-current transition-none" x-show="checked" x-cloak>
        <x-lucide-check class="size-3.5" />
    </span>
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
