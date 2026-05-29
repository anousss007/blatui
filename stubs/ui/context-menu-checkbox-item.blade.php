@props([
    'checked' => false,
    'closeOnSelect' => false,
])

@php $clickExpr = $closeOnSelect ? 'checked = !checked; open = false' : 'checked = !checked'; @endphp

<button
    type="button"
    role="menuitemcheckbox"
    tabindex="-1"
    data-slot="context-menu-checkbox-item"
    x-data="{ checked: {{ $checked ? 'true' : 'false' }} }"
    @click="{{ $clickExpr }}"
    :aria-checked="checked"
    :data-state="checked ? 'checked' : 'unchecked'"
    {{ $attributes->twMerge("focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm py-1.5 pr-2 pl-8 text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    <span class="pointer-events-none absolute left-2 flex size-3.5 items-center justify-center">
        <x-lucide-check class="size-4" x-show="checked" x-cloak />
    </span>
    {{ $slot }}
</button>
