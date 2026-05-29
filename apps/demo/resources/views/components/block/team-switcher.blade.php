@props(['teams' => []])

<x-ui.sidebar-menu x-data="{ active: 0 }">
    <x-ui.sidebar-menu-item>
        <x-ui.dropdown-menu>
            <x-ui.dropdown-menu-trigger class="w-full">
                <x-ui.sidebar-menu-button size="lg"
                    class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                    ::data-state="open ? 'open' : 'closed'">
                    <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                        @foreach ($teams as $i => $team)
                            <span x-show="active === {{ $i }}">
                                <x-dynamic-component :component="'lucide-'.$team['logo']" class="size-4" />
                            </span>
                        @endforeach
                    </div>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                        <span class="truncate font-medium" x-text="{{ \Illuminate\Support\Js::from(array_column($teams, 'name')) }}[active]"></span>
                        <span class="truncate text-xs" x-text="{{ \Illuminate\Support\Js::from(array_column($teams, 'plan')) }}[active]"></span>
                    </div>
                    <x-lucide-chevrons-up-down class="ml-auto" />
                </x-ui.sidebar-menu-button>
            </x-ui.dropdown-menu-trigger>
            <x-ui.dropdown-menu-content class="w-(--radix-dropdown-menu-trigger-width) min-w-56 rounded-lg" align="start" side="right" :side-offset="4">
                <x-ui.dropdown-menu-label class="text-muted-foreground text-xs">Teams</x-ui.dropdown-menu-label>
                @foreach ($teams as $i => $team)
                    <x-ui.dropdown-menu-item x-on:click="active = {{ $i }}" class="gap-2 p-2">
                        <div class="flex size-6 items-center justify-center rounded-md border">
                            <x-dynamic-component :component="'lucide-'.$team['logo']" class="size-3.5 shrink-0" />
                        </div>
                        {{ $team['name'] }}
                        <x-ui.dropdown-menu-shortcut>⌘{{ $i + 1 }}</x-ui.dropdown-menu-shortcut>
                    </x-ui.dropdown-menu-item>
                @endforeach
                <x-ui.dropdown-menu-separator />
                <x-ui.dropdown-menu-item class="gap-2 p-2">
                    <div class="flex size-6 items-center justify-center rounded-md border bg-transparent">
                        <x-lucide-plus class="size-4" />
                    </div>
                    <div class="text-muted-foreground font-medium">Add team</div>
                </x-ui.dropdown-menu-item>
            </x-ui.dropdown-menu-content>
        </x-ui.dropdown-menu>
    </x-ui.sidebar-menu-item>
</x-ui.sidebar-menu>
