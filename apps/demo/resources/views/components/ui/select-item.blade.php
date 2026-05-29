@props([
    'value' => '',
    'disabled' => false,
])

@php $jsVal = \Illuminate\Support\Js::from((string) $value)->toHtml(); @endphp

<div
    role="option"
    data-slot="select-item"
    data-value="{{ $value }}"
    @if ($disabled) data-disabled aria-disabled="true" @endif
    @if (! $disabled)
        @click="value = @js((string) $value); label = $refs.label.textContent.trim(); open = false"
    @endif
    x-init="if (value === @js((string) $value)) label = $refs.label.textContent.trim()"
    :data-state="value === @js((string) $value) ? 'checked' : 'unchecked'"
    {{ $attributes->twMerge("hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm py-1.5 pr-8 pl-2 text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    <span class="absolute right-2 flex size-3.5 items-center justify-center">
        <x-lucide-check class="size-4" x-show="value === {!! $jsVal !!}" x-cloak />
    </span>
    <span x-ref="label">{{ $slot }}</span>
</div>
