@php
    $userClick = $attributes->get('@click') ?? $attributes->get('x-on:click');
    $attributes = $attributes->except(['@click', 'x-on:click']);
    $clickExpr = collect([$userClick, 'open = false'])->filter()->implode('; ');
@endphp

<button
    type="button"
    @click="{{ $clickExpr }}"
    data-slot="alert-dialog-action"
    {{ $attributes->twMerge("inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-primary text-primary-foreground shadow-xs hover:bg-primary/90 h-9 px-4 py-2 has-[>svg]:px-3") }}
>
    {{ $slot }}
</button>
