@props([
    'dataSlot' => 'menu-radio-item',
    'value' => '',
    'closeOnSelect' => false,
])

@php
    $jsVal = \Illuminate\Support\Js::from((string) $value)->toHtml();
    $clickExpr = 'radioValue = '.$jsVal.($closeOnSelect ? '; closeMenu()' : '');
@endphp

<button
    type="button"
    role="menuitemradio"
    tabindex="-1"
    data-slot="{{ $dataSlot }}"
    @click="{{ $clickExpr }}"
    :aria-checked="radioValue === {!! $jsVal !!}"
    :data-state="radioValue === {!! $jsVal !!} ? 'checked' : 'unchecked'"
    {{ $attributes->twMerge("focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm py-1.5 pr-2 pl-8 text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    <span class="pointer-events-none absolute left-2 flex size-3.5 items-center justify-center">
        <x-lucide-circle class="size-2 fill-current" x-show="radioValue === {!! $jsVal !!}" x-cloak aria-hidden="true" />
    </span>
    {{ $slot }}
</button>
