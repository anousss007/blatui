@php
    $quotes = [
        ['quote' => 'BlatUI cut our build time in half. The components just work.', 'name' => 'Sofia Carter', 'role' => 'Lead Engineer', 'initials' => 'SC'],
        ['quote' => 'Accessible by default and beautiful out of the box. A rare combo.', 'name' => 'Jackson Doe', 'role' => 'Design Systems', 'initials' => 'JD'],
        ['quote' => 'Copy, paste, own the code. Exactly how a component library should feel.', 'name' => 'Amelia Bell', 'role' => 'Frontend Dev', 'initials' => 'AB'],
    ];
@endphp
<x-ui.carousel class="w-full max-w-sm">
    <x-ui.carousel-content>
        @foreach ($quotes as $q)
            <x-ui.carousel-item>
                <div class="p-1">
                    <x-ui.card>
                        <x-ui.card-content class="flex flex-col gap-4 p-6">
                            <p class="text-sm leading-relaxed">"{{ $q['quote'] }}"</p>
                            <div class="flex items-center gap-3">
                                <x-ui.avatar class="size-8"><x-ui.avatar-fallback>{{ $q['initials'] }}</x-ui.avatar-fallback></x-ui.avatar>
                                <div class="text-sm">
                                    <div class="font-medium">{{ $q['name'] }}</div>
                                    <div class="text-muted-foreground text-xs">{{ $q['role'] }}</div>
                                </div>
                            </div>
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </x-ui.carousel-item>
        @endforeach
    </x-ui.carousel-content>
    <x-ui.carousel-previous />
    <x-ui.carousel-next />
</x-ui.carousel>
