@props([
    'color' => null,        // any CSS color — becomes the local accent for everything inside
    'foreground' => null,   // text colour on filled accents (buttons/badges); defaults to white
])

@php
    // Rewrites the theme tokens on this subtree only. Every BlatUI component inside — buttons,
    // badges, checkboxes, switches, focus rings, links — recolours, with no per-component props.
    // Renders as display:contents so it never affects layout (override with a class if you need a box).
    $style = '';
    if ($color) {
        $fg = $foreground ?: '#ffffff';
        $style = "--primary: {$color}; --secondary: {$color}; --ring: {$color}; --sidebar-primary: {$color}; --primary-foreground: {$fg};";
    }
    $userStyle = (string) $attributes->get('style', '');
    $style = trim($style.($style && $userStyle ? ' ' : '').$userStyle);
    $attributes = $attributes->except('style');
@endphp

<div data-slot="accent" @if ($style) style="{{ $style }}" @endif {{ $attributes->twMerge('contents') }}>
    {{ $slot }}
</div>
