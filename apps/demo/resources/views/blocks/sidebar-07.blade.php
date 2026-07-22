@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];
    $teams = [
        ['name' => 'Acme Inc', 'logo' => 'gallery-vertical-end', 'plan' => 'Enterprise'],
        ['name' => 'Acme Corp.', 'logo' => 'audio-waveform', 'plan' => 'Startup'],
        ['name' => 'Evil Corp.', 'logo' => 'command', 'plan' => 'Free'],
    ];
    $navMain = [
        ['title' => 'Playground', 'icon' => 'square-terminal', 'isActive' => true, 'items' => [
            ['title' => 'History'], ['title' => 'Starred'], ['title' => 'Settings'],
        ]],
        ['title' => 'Models', 'icon' => 'bot', 'items' => [
            ['title' => 'Genesis'], ['title' => 'Explorer'], ['title' => 'Quantum'],
        ]],
        ['title' => 'Documentation', 'icon' => 'book-open', 'items' => [
            ['title' => 'Introduction'], ['title' => 'Get Started'], ['title' => 'Tutorials'], ['title' => 'Changelog'],
        ]],
        ['title' => 'Settings', 'icon' => 'settings-2', 'items' => [
            ['title' => 'General'], ['title' => 'Team'], ['title' => 'Billing'], ['title' => 'Limits'],
        ]],
    ];
    $projects = [
        ['name' => 'Design Engineering', 'icon' => 'frame'],
        ['name' => 'Sales & Marketing', 'icon' => 'pie-chart'],
        ['name' => 'Travel', 'icon' => 'map'],
    ];
@endphp

<x-layouts.app title="Sidebar 07">
    <x-ui.sidebar-provider>
        <x-ui.sidebar collapsible="icon">
            <x-ui.sidebar-header>
                <x-block.team-switcher :teams="$teams" />
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-block.nav-main :items="$navMain" />
                <x-block.nav-projects :projects="$projects" />
            </x-ui.sidebar-content>
            <x-ui.sidebar-footer>
                <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" />
            </x-ui.sidebar-footer>
            <x-ui.sidebar-rail />
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-[[data-collapsible=icon]]/sidebar-wrapper:h-12">
                <div class="flex items-center gap-2 px-4">
                    <x-ui.sidebar-trigger class="-ml-1" />
                    <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                    <x-ui.breadcrumb>
                        <x-ui.breadcrumb-list>
                            <x-ui.breadcrumb-item class="hidden md:block">
                                <x-ui.breadcrumb-link href="#">Building Your Application</x-ui.breadcrumb-link>
                            </x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-separator class="hidden md:block" />
                            <x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-page>Data Fetching</x-ui.breadcrumb-page>
                            </x-ui.breadcrumb-item>
                        </x-ui.breadcrumb-list>
                    </x-ui.breadcrumb>
                </div>
            </header>
            <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
                <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                    <div class="bg-muted/50 aspect-video rounded-xl"></div>
                    <div class="bg-muted/50 aspect-video rounded-xl"></div>
                    <div class="bg-muted/50 aspect-video rounded-xl"></div>
                </div>
                <div class="bg-muted/50 min-h-[100vh] flex-1 rounded-xl md:min-h-min"></div>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
