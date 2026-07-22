{{-- Multiple files in one block, switched with tabs. --}}
<x-ui.tabs value="blade" class="w-full max-w-lg gap-0">
    <x-ui.tabs-list class="rounded-b-none">
        <x-ui.tabs-trigger value="blade">page.blade.php</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="css">app.css</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <x-ui.tabs-content value="blade" class="mt-0">
        <x-ui.code-block class="rounded-t-none">@verbatim
<x-ui.card variant="sectioned">
    <x-ui.card-header>
        <x-ui.card-title>Welcome</x-ui.card-title>
    </x-ui.card-header>
</x-ui.card>
@endverbatim</x-ui.code-block>
    </x-ui.tabs-content>
    <x-ui.tabs-content value="css" class="mt-0">
        <x-ui.code-block class="rounded-t-none">@verbatim
@import 'tailwindcss';
@source '../views';
@endverbatim</x-ui.code-block>
    </x-ui.tabs-content>
</x-ui.tabs>
