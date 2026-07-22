@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];
    $navMain = [
        ['title' => 'Inbox', 'icon' => 'inbox'],
        ['title' => 'Drafts', 'icon' => 'file'],
        ['title' => 'Sent', 'icon' => 'send'],
        ['title' => 'Junk', 'icon' => 'archive-x'],
        ['title' => 'Trash', 'icon' => 'trash-2'],
    ];
    $mails = [
        ['name' => 'William Smith', 'email' => 'williamsmith@example.com', 'subject' => 'Meeting Tomorrow', 'date' => '09:34 AM', 'teaser' => "Hi team, just a reminder about our meeting tomorrow at 10 AM.\nPlease come prepared with your project updates."],
        ['name' => 'Alice Smith', 'email' => 'alicesmith@example.com', 'subject' => 'Re: Project Update', 'date' => 'Yesterday', 'teaser' => "Thanks for the update. The progress looks great so far.\nLet's schedule a call to discuss the next steps."],
        ['name' => 'Bob Johnson', 'email' => 'bobjohnson@example.com', 'subject' => 'Weekend Plans', 'date' => '2 days ago', 'teaser' => "Hey everyone! I'm thinking of organizing a team outing this weekend.\nWould you be interested in a hiking trip or a beach day?"],
        ['name' => 'Emily Davis', 'email' => 'emilydavis@example.com', 'subject' => 'Re: Question about Budget', 'date' => '2 days ago', 'teaser' => "I've reviewed the budget numbers you sent over.\nCan we set up a quick call to discuss some potential adjustments?"],
        ['name' => 'Michael Wilson', 'email' => 'michaelwilson@example.com', 'subject' => 'Important Announcement', 'date' => '1 week ago', 'teaser' => "Please join us for an all-hands meeting this Friday at 3 PM.\nWe have some exciting news to share about the company's future."],
        ['name' => 'Sarah Brown', 'email' => 'sarahbrown@example.com', 'subject' => 'Re: Feedback on Proposal', 'date' => '1 week ago', 'teaser' => "Thank you for sending over the proposal. I've reviewed it and have some thoughts.\nCould we schedule a meeting to discuss my feedback in detail?"],
        ['name' => 'David Lee', 'email' => 'davidlee@example.com', 'subject' => 'New Project Idea', 'date' => '1 week ago', 'teaser' => "I've been brainstorming and came up with an interesting project concept.\nDo you have time this week to discuss its potential impact and feasibility?"],
        ['name' => 'Olivia Wilson', 'email' => 'oliviawilson@example.com', 'subject' => 'Vacation Plans', 'date' => '1 week ago', 'teaser' => "Just a heads up that I'll be taking a two-week vacation next month.\nI'll make sure all my projects are up to date before I leave."],
        ['name' => 'James Martin', 'email' => 'jamesmartin@example.com', 'subject' => 'Re: Conference Registration', 'date' => '1 week ago', 'teaser' => "I've completed the registration for the upcoming tech conference.\nLet me know if you need any additional information from my end."],
        ['name' => 'Sophia White', 'email' => 'sophiawhite@example.com', 'subject' => 'Team Dinner', 'date' => '1 week ago', 'teaser' => "To celebrate our recent project success, I'd like to organize a team dinner.\nAre you available next Friday evening? Please let me know your preferences."],
    ];
@endphp

<x-layouts.app title="Sidebar 09">
    <x-ui.sidebar-provider style="--sidebar-width: 350px">
        <x-ui.sidebar collapsible="icon" class="overflow-hidden *:data-[sidebar=sidebar]:flex-row" x-data="{ active: 'Inbox' }">
            <x-ui.sidebar collapsible="none" class="w-[calc(var(--sidebar-width-icon)+1px)]! border-r">
                <x-ui.sidebar-header>
                    <x-ui.sidebar-menu>
                        <x-ui.sidebar-menu-item>
                            <x-ui.sidebar-menu-button size="lg" href="#" class="md:h-8 md:p-0">
                                <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                                    <x-lucide-command class="size-4" />
                                </div>
                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-medium">Acme Inc</span>
                                    <span class="truncate text-xs">Enterprise</span>
                                </div>
                            </x-ui.sidebar-menu-button>
                        </x-ui.sidebar-menu-item>
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-header>
                <x-ui.sidebar-content>
                    <x-ui.sidebar-group>
                        <x-ui.sidebar-group-content class="px-1.5 md:px-0">
                            <x-ui.sidebar-menu>
                                @foreach ($navMain as $item)
                                    <x-ui.sidebar-menu-item>
                                        <x-ui.sidebar-menu-button class="px-2.5 md:px-2"
                                            x-on:click="active = '{{ $item['title'] }}'; open = true"
                                            ::data-active="active === '{{ $item['title'] }}'">
                                            <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                            <span>{{ $item['title'] }}</span>
                                        </x-ui.sidebar-menu-button>
                                    </x-ui.sidebar-menu-item>
                                @endforeach
                            </x-ui.sidebar-menu>
                        </x-ui.sidebar-group-content>
                    </x-ui.sidebar-group>
                </x-ui.sidebar-content>
                <x-ui.sidebar-footer>
                    <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" />
                </x-ui.sidebar-footer>
            </x-ui.sidebar>

            <x-ui.sidebar collapsible="none" class="hidden flex-1 md:flex">
                <x-ui.sidebar-header class="gap-3.5 border-b p-4">
                    <div class="flex w-full items-center justify-between">
                        <div class="text-foreground text-base font-medium" x-text="active"></div>
                        <x-ui.label class="flex items-center gap-2 text-sm">
                            <span>Unreads</span>
                            <x-ui.switch class="shadow-none" />
                        </x-ui.label>
                    </div>
                    <x-ui.sidebar-input placeholder="Type to search..." />
                </x-ui.sidebar-header>
                <x-ui.sidebar-content>
                    <x-ui.sidebar-group class="px-0">
                        <x-ui.sidebar-group-content>
                            @foreach ($mails as $mail)
                                <a href="#" class="hover:bg-sidebar-accent hover:text-sidebar-accent-foreground flex flex-col items-start gap-2 border-b p-4 text-sm leading-tight whitespace-nowrap last:border-b-0">
                                    <div class="flex w-full items-center gap-2">
                                        <span>{{ $mail['name'] }}</span>
                                        <span class="ml-auto text-xs">{{ $mail['date'] }}</span>
                                    </div>
                                    <span class="font-medium">{{ $mail['subject'] }}</span>
                                    <span class="line-clamp-2 w-[260px] text-xs whitespace-break-spaces">{{ $mail['teaser'] }}</span>
                                </a>
                            @endforeach
                        </x-ui.sidebar-group-content>
                    </x-ui.sidebar-group>
                </x-ui.sidebar-content>
            </x-ui.sidebar>
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="bg-background sticky top-0 flex shrink-0 items-center gap-2 border-b p-4">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <x-ui.breadcrumb>
                    <x-ui.breadcrumb-list>
                        <x-ui.breadcrumb-item class="hidden md:block">
                            <x-ui.breadcrumb-link href="#">All Inboxes</x-ui.breadcrumb-link>
                        </x-ui.breadcrumb-item>
                        <x-ui.breadcrumb-separator class="hidden md:block" />
                        <x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-page>Inbox</x-ui.breadcrumb-page>
                        </x-ui.breadcrumb-item>
                    </x-ui.breadcrumb-list>
                </x-ui.breadcrumb>
            </header>
            <div class="flex flex-1 flex-col gap-4 p-4">
                @for ($i = 0; $i < 24; $i++)
                    <div class="bg-muted/50 aspect-video h-12 w-full rounded-lg"></div>
                @endfor
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
