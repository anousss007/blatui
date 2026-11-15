@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title.' — BlatUI Starter' : 'BlatUI Starter' }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">

    {{-- No-flash: apply every persisted theme dimension before first paint. Mirrors
         Alpine.store('theme').apply(), which takes over once Alpine boots and puts these back
         after each wire:navigate visit (Livewire drops <html> attributes the server did not
         send). The mode falls back to light, the store's default; with
         registerBlatUI(Alpine, { darkMode: 'system' }) make it 'system' here too. --}}
    <script>
        (function () {
            const root = document.documentElement;
            const get = (k, d) => localStorage.getItem('theme:' + k) || d;
            const mode = get('mode', 'light');
            const dark = mode === 'dark' || (mode === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            root.classList.toggle('dark', dark);
            const set = (a, v, f) => { if (v && v !== f) root.setAttribute(a, v); else root.removeAttribute(a); };
            set('data-base', get('base', 'neutral'), 'neutral');
            set('data-theme', get('preset', 'default'), 'default');
            set('data-font', get('font', 'sans'), 'sans');
            set('data-shadow', get('shadow', 'default'), 'default');
            set('data-spacing', get('spacing', 'default'), 'default');
            set('data-tracking', get('tracking', 'normal'), 'normal');
            set('data-input-style', get('inputStyle', 'outline'), 'outline');
            set('data-font-heading', get('fontHeading', 'sans'), 'sans');
            root.setAttribute('data-radius', get('radius', '0.625'));
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground min-h-screen font-sans antialiased">
    {{ $slot }}
</body>
</html>
