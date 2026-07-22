@props(['item'])

@php
    $parts = is_array($item) ? $item : [$item];
    $name = $parts[0];
    $children = array_slice($parts, 1);
@endphp

@if (empty($children))
    <x-ui.sidebar-menu-button :is-active="$name === 'button.tsx'" class="data-[active=true]:bg-transparent">
        <x-lucide-file />
        {{ $name }}
    </x-ui.sidebar-menu-button>
@else
    <x-ui.sidebar-menu-item>
        <x-ui.collapsible class="group/collapsible [&[data-state=open]>button>svg:first-child]:rotate-90"
            :open="in_array($name, ['components', 'ui'])" ::data-state="open ? 'open' : 'closed'">
            <x-ui.sidebar-menu-button x-on:click="open = !open" ::data-state="open ? 'open' : 'closed'">
                <x-lucide-chevron-right class="transition-transform" />
                <x-lucide-folder />
                {{ $name }}
            </x-ui.sidebar-menu-button>
            <x-ui.collapsible-content>
                <x-ui.sidebar-menu-sub>
                    @foreach ($children as $child)
                        <x-block.file-tree :item="$child" />
                    @endforeach
                </x-ui.sidebar-menu-sub>
            </x-ui.collapsible-content>
        </x-ui.collapsible>
    </x-ui.sidebar-menu-item>
@endif
