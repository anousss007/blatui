@props(['versions' => [], 'default' => null])

@php $default = $default ?? ($versions[0] ?? ''); @endphp

<x-ui.sidebar-menu>
    <x-ui.sidebar-menu-item x-data="{ selected: '{{ $default }}' }">
        <x-ui.dropdown-menu>
            <x-ui.dropdown-menu-trigger class="w-full">
                <x-ui.sidebar-menu-button size="lg"
                    class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                    ::data-state="open ? 'open' : 'closed'">
                    <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                        <x-lucide-gallery-vertical-end class="size-4" />
                    </div>
                    <div class="flex flex-col gap-0.5 leading-none">
                        <span class="font-medium">Documentation</span>
                        <span x-text="'v' + selected"></span>
                    </div>
                    <x-lucide-chevrons-up-down class="ml-auto" />
                </x-ui.sidebar-menu-button>
            </x-ui.dropdown-menu-trigger>
            <x-ui.dropdown-menu-content align="start" class="w-(--radix-popper-anchor-width) min-w-56">
                @foreach ($versions as $version)
                    <x-ui.dropdown-menu-item x-on:click="selected = '{{ $version }}'">
                        v{{ $version }}
                        <x-lucide-check class="ml-auto" x-show="selected === '{{ $version }}'" x-cloak />
                    </x-ui.dropdown-menu-item>
                @endforeach
            </x-ui.dropdown-menu-content>
        </x-ui.dropdown-menu>
    </x-ui.sidebar-menu-item>
</x-ui.sidebar-menu>
