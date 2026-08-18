<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title ?? 'BlatUI morph testbed' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-background text-foreground min-h-full antialiased">
        <main class="mx-auto flex max-w-2xl flex-col gap-8 p-8">
            {{ $slot }}
        </main>
    </body>
</html>
