@props([
    'value' => null,
    'id' => null,
    'disabled' => false,
])

<button
    type="button"
    role="radio"
    data-value="{{ $value }}"
    @if ($id) id="{{ $id }}" @endif
    @click="value = @js($value); rovingValue = @js($value)"
    @focus="rovingValue = @js($value)"
    :data-state="value === @js($value) ? 'checked' : 'unchecked'"
    :aria-checked="(value === @js($value)).toString()"
    :tabindex="rovingValue === @js($value) ? 0 : -1"
    @if ($disabled) disabled @endif
    data-slot="radio-group-item"
    {{ $attributes->twMerge('border-input text-primary dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive aspect-square size-4 shrink-0 rounded-full border shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50') }}
>
    <span data-slot="radio-group-indicator" class="relative flex items-center justify-center" x-show="value === @js($value)" x-cloak>
        <x-lucide-circle aria-hidden="true" class="fill-current absolute top-1/2 left-1/2 size-2 -translate-x-1/2 -translate-y-1/2" />
    </span>
</button>
