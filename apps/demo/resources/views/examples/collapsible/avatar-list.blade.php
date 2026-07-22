{{-- An expandable member list with avatars. --}}
<x-ui.collapsible class="w-[320px] rounded-lg border">
    <x-ui.collapsible-trigger class="flex w-full items-center justify-between gap-2 p-3 text-sm font-medium">
        <span class="flex items-center gap-2"><x-lucide-users class="text-muted-foreground size-4" aria-hidden="true" /> 3 team members</span>
        <x-lucide-chevron-down class="text-muted-foreground size-4 transition-transform [[data-state=open]>&]:rotate-180" aria-hidden="true" />
    </x-ui.collapsible-trigger>
    <x-ui.collapsible-content class="divide-y border-t">
        @foreach ([['CN', 'shadcn', 'm@example.com'], ['LR', 'leerob', 'lee@example.com'], ['ER', 'evilrabbit', 'rabbit@example.com']] as [$initials, $name, $email])
            <div class="flex items-center gap-3 p-3">
                <x-ui.avatar class="size-8"><x-ui.avatar-fallback>{{ $initials }}</x-ui.avatar-fallback></x-ui.avatar>
                <div class="grid">
                    <span class="text-sm font-medium">{{ $name }}</span>
                    <span class="text-muted-foreground text-xs">{{ $email }}</span>
                </div>
            </div>
        @endforeach
    </x-ui.collapsible-content>
</x-ui.collapsible>
