@php
    $people = [
        ['name' => 'Sofia Carter', 'email' => 'sofia@example.com', 'initials' => 'SC'],
        ['name' => 'Jackson Doe', 'email' => 'jackson@example.com', 'initials' => 'JD'],
        ['name' => 'Amelia Bell', 'email' => 'amelia@example.com', 'initials' => 'AB'],
    ];
@endphp
<x-ui.item-group class="w-full max-w-md rounded-lg border">
    @foreach ($people as $i => $p)
        <x-ui.item>
            <x-ui.item-media>
                <x-ui.avatar><x-ui.avatar-fallback>{{ $p['initials'] }}</x-ui.avatar-fallback></x-ui.avatar>
            </x-ui.item-media>
            <x-ui.item-content>
                <x-ui.item-title>{{ $p['name'] }}</x-ui.item-title>
                <x-ui.item-description>{{ $p['email'] }}</x-ui.item-description>
            </x-ui.item-content>
            <x-ui.item-actions>
                <x-ui.button variant="ghost" size="icon-sm" aria-label="Options for {{ $p['name'] }}"><x-lucide-more-horizontal aria-hidden="true" /></x-ui.button>
            </x-ui.item-actions>
        </x-ui.item>
        @if ($i < count($people) - 1)
            <x-ui.item-separator />
        @endif
    @endforeach
</x-ui.item-group>
