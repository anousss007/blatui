@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title.' — BlatUI Starter' : 'BlatUI Starter' }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">

    {{-- No-flash: apply the persisted theme before first paint --}}
    <script>
        (function () {
            const root = document.documentElement;
            const get = (k, d) => localStorage.getItem('theme:' + k) || d;
            const mode = get('mode', 'system');
            const dark = mode === 'dark' || (mode === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            root.classList.toggle('dark', dark);
            const set = (a, v, f) => { if (v && v !== f) root.setAttribute(a, v); else root.removeAttribute(a); };
            set('data-base', get('base', 'neutral'), 'neutral');
            set('data-theme', get('preset', 'default'), 'default');
            root.setAttribute('data-radius', get('radius', '0.625'));
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground min-h-screen font-sans antialiased">
    {{ $slot }}
</body>
</html>
