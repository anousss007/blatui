@props([
    'id' => null,
    'name' => null,
    'value' => 'on',
    'checked' => false,
    'disabled' => false,
    'indeterminate' => false,
])

<button
    type="button"
    role="checkbox"
    @if ($id) id="{{ $id }}" @endif
    x-data="{ checked: @js((bool) $checked), indeterminate: @js((bool) $indeterminate) }"
    :data-state="indeterminate ? 'indeterminate' : (checked ? 'checked' : 'unchecked')"
    :aria-checked="indeterminate ? 'mixed' : checked.toString()"
    @click="indeterminate ? (indeterminate = false, checked = true) : (checked = !checked)"
    @if ($disabled) disabled @endif
    data-slot="checkbox"
    {{ $attributes->twMerge('peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground dark:data-[state=checked]:bg-primary data-[state=checked]:border-primary data-[state=indeterminate]:bg-primary data-[state=indeterminate]:text-primary-foreground data-[state=indeterminate]:border-primary focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive size-4 shrink-0 rounded-[4px] border shadow-xs transition-shadow outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 flex items-center justify-center') }}
>
    <span data-slot="checkbox-indicator" class="flex items-center justify-center text-current transition-none" x-show="checked || indeterminate" x-cloak>
        <x-lucide-minus class="size-3.5" x-show="indeterminate" aria-hidden="true" />
        <x-lucide-check class="size-3.5" x-show="!indeterminate" aria-hidden="true" />
    </span>
    {{-- Hidden (non-interactive) input carries the value for form submission; type=hidden
         is valid inside a button and avoids a nested interactive control. --}}
    @if ($name)
        <input type="hidden" :name="checked && !indeterminate ? @js($name) : null" value="{{ $value }}">
    @endif
</button>
