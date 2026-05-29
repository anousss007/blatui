@props([
    'title' => null,
    'description' => null,
])

@php
    $brand = config('brand.name');
    $description = $description ?: config('brand.description');
    $homeTitle = $brand.' — '.config('brand.tagline');
    // Pages pass a short title ("Blocks"); append the brand unless it's already there.
    $fullTitle = ! $title ? $homeTitle : (str_contains($title, $brand) ? $title : $title.' — '.$brand);
    $canonical = url()->current();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0a0a0a" media="(prefers-color-scheme: dark)">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $brand }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ url('/og.svg') }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ url('/og.svg') }}">

    {{-- Icons --}}
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/favicon.svg">

    {{-- No-flash: apply every persisted theme dimension before first paint --}}
    <script>
        (function () {
            const root = document.documentElement;
            const get = (k, d) => localStorage.getItem('theme:' + k) || d;
            const mode = get('mode', 'system');
            const dark = mode === 'dark' || (mode === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            root.classList.toggle('dark', dark);
            const set = (attr, val, fallback) => {
                if (val && val !== fallback) root.setAttribute(attr, val);
                else root.removeAttribute(attr);
            };
            set('data-base', get('base', 'neutral'), 'neutral');
            set('data-theme', get('preset', 'default'), 'default');
            set('data-font', get('font', 'sans'), 'sans');
            set('data-shadow', get('shadow', 'default'), 'default');
            set('data-spacing', get('spacing', 'default'), 'default');
            set('data-tracking', get('tracking', 'normal'), 'normal');
            root.setAttribute('data-radius', get('radius', '0.625'));
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data class="min-h-screen bg-background font-sans text-foreground antialiased">
    {{ $slot }}
</body>
</html>
