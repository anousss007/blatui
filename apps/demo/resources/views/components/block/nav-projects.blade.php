@props(['projects' => [], 'label' => 'Projects'])

<x-ui.sidebar-group class="group-data-[collapsible=icon]:hidden">
    <x-ui.sidebar-group-label>{{ $label }}</x-ui.sidebar-group-label>
    <x-ui.sidebar-menu>
        @foreach ($projects as $project)
            <x-ui.sidebar-menu-item>
                <x-ui.sidebar-menu-button href="#">
                    <x-dynamic-component :component="'lucide-'.$project['icon']" />
                    <span>{{ $project['name'] }}</span>
                </x-ui.sidebar-menu-button>
                <x-ui.dropdown-menu>
                    <x-ui.dropdown-menu-trigger>
                        <x-ui.sidebar-menu-action :show-on-hover="true">
                            <x-lucide-more-horizontal />
                            <span class="sr-only">More</span>
                        </x-ui.sidebar-menu-action>
                    </x-ui.dropdown-menu-trigger>
                    <x-ui.dropdown-menu-content class="w-48 rounded-lg" side="right" align="start">
                        <x-ui.dropdown-menu-item>
                            <x-lucide-folder class="text-muted-foreground" />
                            <span>View Project</span>
                        </x-ui.dropdown-menu-item>
                        <x-ui.dropdown-menu-item>
                            <x-lucide-forward class="text-muted-foreground" />
                            <span>Share Project</span>
                        </x-ui.dropdown-menu-item>
                        <x-ui.dropdown-menu-separator />
                        <x-ui.dropdown-menu-item>
                            <x-lucide-trash-2 class="text-muted-foreground" />
                            <span>Delete Project</span>
                        </x-ui.dropdown-menu-item>
                    </x-ui.dropdown-menu-content>
                </x-ui.dropdown-menu>
            </x-ui.sidebar-menu-item>
        @endforeach
        <x-ui.sidebar-menu-item>
            <x-ui.sidebar-menu-button class="text-sidebar-foreground/70">
                <x-lucide-more-horizontal class="text-sidebar-foreground/70" />
                <span>More</span>
            </x-ui.sidebar-menu-button>
        </x-ui.sidebar-menu-item>
    </x-ui.sidebar-menu>
</x-ui.sidebar-group>
