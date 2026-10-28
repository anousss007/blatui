<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title ?? 'BlatUI sidebar testbed' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-background text-foreground antialiased">
        <x-ui.sidebar-provider persist>
            
                <livewire:nav-sidebar base="/nav-plain" />
            
            <x-ui.sidebar-inset class="p-8">
                {{-- Outside @persist, the way an app header carries it (#57). --}}
                <x-ui.sidebar-trigger data-testid="sidebar-trigger" />
                {{ $slot }}
            </x-ui.sidebar-inset>
        </x-ui.sidebar-provider>
    </body>
</html>
