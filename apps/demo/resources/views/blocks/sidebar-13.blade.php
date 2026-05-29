@php
    $nav = [
        ['name' => 'Notifications', 'icon' => 'bell'],
        ['name' => 'Navigation', 'icon' => 'menu'],
        ['name' => 'Home', 'icon' => 'home'],
        ['name' => 'Appearance', 'icon' => 'paintbrush'],
        ['name' => 'Messages & media', 'icon' => 'message-circle'],
        ['name' => 'Language & region', 'icon' => 'globe'],
        ['name' => 'Accessibility', 'icon' => 'keyboard'],
        ['name' => 'Mark as read', 'icon' => 'check'],
        ['name' => 'Audio & video', 'icon' => 'video'],
        ['name' => 'Connected accounts', 'icon' => 'link'],
        ['name' => 'Privacy & visibility', 'icon' => 'lock'],
        ['name' => 'Advanced', 'icon' => 'settings'],
    ];
@endphp

<x-layouts.app title="Sidebar 13">
    <div class="flex h-svh items-center justify-center">
        <x-ui.dialog :open="true">
            <x-ui.dialog-trigger>
                <x-ui.button size="sm">Open Dialog</x-ui.button>
            </x-ui.dialog-trigger>
            <x-ui.dialog-content class="overflow-hidden p-0 md:max-h-[500px] md:max-w-[700px] lg:max-w-[800px]">
                <x-ui.dialog-title class="sr-only">Settings</x-ui.dialog-title>
                <x-ui.dialog-description class="sr-only">Customize your settings here.</x-ui.dialog-description>
                <x-ui.sidebar-provider class="items-start">
                    <x-ui.sidebar collapsible="none" class="hidden md:flex">
                        <x-ui.sidebar-content>
                            <x-ui.sidebar-group>
                                <x-ui.sidebar-group-content>
                                    <x-ui.sidebar-menu>
                                        @foreach ($nav as $item)
                                            <x-ui.sidebar-menu-item>
                                                <x-ui.sidebar-menu-button href="#" :is-active="$item['name'] === 'Messages & media'">
                                                    <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                                    <span>{{ $item['name'] }}</span>
                                                </x-ui.sidebar-menu-button>
                                            </x-ui.sidebar-menu-item>
                                        @endforeach
                                    </x-ui.sidebar-menu>
                                </x-ui.sidebar-group-content>
                            </x-ui.sidebar-group>
                        </x-ui.sidebar-content>
                    </x-ui.sidebar>
                    <main class="flex h-[480px] flex-1 flex-col overflow-hidden">
                        <header class="flex h-16 shrink-0 items-center gap-2">
                            <div class="flex items-center gap-2 px-4">
                                <x-ui.breadcrumb>
                                    <x-ui.breadcrumb-list>
                                        <x-ui.breadcrumb-item class="hidden md:block">
                                            <x-ui.breadcrumb-link href="#">Settings</x-ui.breadcrumb-link>
                                        </x-ui.breadcrumb-item>
                                        <x-ui.breadcrumb-separator class="hidden md:block" />
                                        <x-ui.breadcrumb-item>
                                            <x-ui.breadcrumb-page>Messages &amp; media</x-ui.breadcrumb-page>
                                        </x-ui.breadcrumb-item>
                                    </x-ui.breadcrumb-list>
                                </x-ui.breadcrumb>
                            </div>
                        </header>
                        <div class="flex flex-1 flex-col gap-4 overflow-y-auto p-4 pt-0">
                            @for ($i = 0; $i < 10; $i++)
                                <div class="bg-muted/50 aspect-video max-w-3xl rounded-xl"></div>
                            @endfor
                        </div>
                    </main>
                </x-ui.sidebar-provider>
            </x-ui.dialog-content>
        </x-ui.dialog>
    </div>
</x-layouts.app>
