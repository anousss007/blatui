@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];

    $navMain = [
        ['title' => 'Dashboard', 'icon' => 'layout-dashboard'],
        ['title' => 'Lifecycle', 'icon' => 'list-todo'],
        ['title' => 'Analytics', 'icon' => 'chart-bar'],
        ['title' => 'Projects', 'icon' => 'folder'],
        ['title' => 'Team', 'icon' => 'users'],
    ];

    $documents = [
        ['name' => 'Data Library', 'icon' => 'database'],
        ['name' => 'Reports', 'icon' => 'file-chart-column'],
        ['name' => 'Word Assistant', 'icon' => 'file-text'],
    ];

    $navSecondary = [
        ['title' => 'Settings', 'icon' => 'settings'],
        ['title' => 'Get Help', 'icon' => 'circle-help'],
        ['title' => 'Search', 'icon' => 'search'],
    ];

    $cards = [
        ['desc' => 'Total Revenue', 'value' => '$1,250.00', 'badge' => '+12.5%', 'up' => true, 'line' => 'Trending up this month', 'sub' => 'Visitors for the last 6 months'],
        ['desc' => 'New Customers', 'value' => '1,234', 'badge' => '-20%', 'up' => false, 'line' => 'Down 20% this period', 'sub' => 'Acquisition needs attention'],
        ['desc' => 'Active Accounts', 'value' => '45,678', 'badge' => '+12.5%', 'up' => true, 'line' => 'Strong user retention', 'sub' => 'Engagement exceed targets'],
        ['desc' => 'Growth Rate', 'value' => '4.5%', 'badge' => '+4.5%', 'up' => true, 'line' => 'Steady performance increase', 'sub' => 'Meets growth projections'],
    ];

    $tableData = [
        ['id'=>1,'header'=>'Cover page','type'=>'Cover page','status'=>'In Process','target'=>'18','limit'=>'5','reviewer'=>'Eddie Lake'],
        ['id'=>2,'header'=>'Table of contents','type'=>'Table of contents','status'=>'Done','target'=>'29','limit'=>'24','reviewer'=>'Eddie Lake'],
        ['id'=>3,'header'=>'Executive summary','type'=>'Narrative','status'=>'Done','target'=>'10','limit'=>'13','reviewer'=>'Eddie Lake'],
        ['id'=>4,'header'=>'Technical approach','type'=>'Narrative','status'=>'Done','target'=>'27','limit'=>'23','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>5,'header'=>'Design','type'=>'Narrative','status'=>'In Process','target'=>'2','limit'=>'16','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>6,'header'=>'Capabilities','type'=>'Narrative','status'=>'In Process','target'=>'20','limit'=>'8','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>7,'header'=>'Integration with existing systems','type'=>'Narrative','status'=>'In Process','target'=>'19','limit'=>'21','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>8,'header'=>'Innovation and Advantages','type'=>'Narrative','status'=>'Done','target'=>'25','limit'=>'26','reviewer'=>'Assign reviewer'],
        ['id'=>9,'header'=>"Overview of EMR's Innovative Solutions",'type'=>'Technical content','status'=>'Done','target'=>'7','limit'=>'23','reviewer'=>'Assign reviewer'],
        ['id'=>10,'header'=>'Advanced Algorithms and Machine Learning','type'=>'Narrative','status'=>'Done','target'=>'30','limit'=>'28','reviewer'=>'Assign reviewer'],
        ['id'=>11,'header'=>'Adaptive Communication Protocols','type'=>'Narrative','status'=>'Done','target'=>'9','limit'=>'31','reviewer'=>'Assign reviewer'],
        ['id'=>12,'header'=>'Advantages Over Current Technologies','type'=>'Narrative','status'=>'Done','target'=>'12','limit'=>'0','reviewer'=>'Assign reviewer'],
        ['id'=>13,'header'=>'Past Performance','type'=>'Narrative','status'=>'Done','target'=>'22','limit'=>'33','reviewer'=>'Assign reviewer'],
        ['id'=>14,'header'=>'Customer Feedback and Satisfaction Levels','type'=>'Narrative','status'=>'Done','target'=>'15','limit'=>'34','reviewer'=>'Assign reviewer'],
        ['id'=>15,'header'=>'Implementation Challenges and Solutions','type'=>'Narrative','status'=>'Done','target'=>'3','limit'=>'35','reviewer'=>'Assign reviewer'],
        ['id'=>16,'header'=>'Security Measures and Data Protection Policies','type'=>'Narrative','status'=>'In Process','target'=>'6','limit'=>'36','reviewer'=>'Assign reviewer'],
        ['id'=>17,'header'=>'Scalability and Future Proofing','type'=>'Narrative','status'=>'Done','target'=>'4','limit'=>'37','reviewer'=>'Assign reviewer'],
        ['id'=>18,'header'=>'Cost-Benefit Analysis','type'=>'Plain language','status'=>'Done','target'=>'14','limit'=>'38','reviewer'=>'Assign reviewer'],
        ['id'=>19,'header'=>'User Training and Onboarding Experience','type'=>'Narrative','status'=>'Done','target'=>'17','limit'=>'39','reviewer'=>'Assign reviewer'],
        ['id'=>20,'header'=>'Future Development Roadmap','type'=>'Narrative','status'=>'Done','target'=>'11','limit'=>'40','reviewer'=>'Assign reviewer'],
        ['id'=>21,'header'=>'System Architecture Overview','type'=>'Technical content','status'=>'In Process','target'=>'24','limit'=>'18','reviewer'=>'Maya Johnson'],
        ['id'=>22,'header'=>'Risk Management Plan','type'=>'Narrative','status'=>'Done','target'=>'15','limit'=>'22','reviewer'=>'Carlos Rodriguez'],
        ['id'=>23,'header'=>'Compliance Documentation','type'=>'Legal','status'=>'In Process','target'=>'31','limit'=>'27','reviewer'=>'Sarah Chen'],
        ['id'=>24,'header'=>'API Documentation','type'=>'Technical content','status'=>'Done','target'=>'8','limit'=>'12','reviewer'=>'Raj Patel'],
        ['id'=>25,'header'=>'User Interface Mockups','type'=>'Visual','status'=>'In Process','target'=>'19','limit'=>'25','reviewer'=>'Leila Ahmadi'],
        ['id'=>26,'header'=>'Database Schema','type'=>'Technical content','status'=>'Done','target'=>'22','limit'=>'20','reviewer'=>'Thomas Wilson'],
        ['id'=>27,'header'=>'Testing Methodology','type'=>'Technical content','status'=>'In Process','target'=>'17','limit'=>'14','reviewer'=>'Assign reviewer'],
        ['id'=>28,'header'=>'Deployment Strategy','type'=>'Narrative','status'=>'Done','target'=>'26','limit'=>'30','reviewer'=>'Eddie Lake'],
        ['id'=>29,'header'=>'Budget Breakdown','type'=>'Financial','status'=>'In Process','target'=>'13','limit'=>'16','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>30,'header'=>'Market Analysis','type'=>'Research','status'=>'Done','target'=>'29','limit'=>'32','reviewer'=>'Sophia Martinez'],
        ['id'=>31,'header'=>'Competitor Comparison','type'=>'Research','status'=>'In Process','target'=>'21','limit'=>'19','reviewer'=>'Assign reviewer'],
        ['id'=>32,'header'=>'Maintenance Plan','type'=>'Technical content','status'=>'Done','target'=>'16','limit'=>'23','reviewer'=>'Alex Thompson'],
        ['id'=>33,'header'=>'User Personas','type'=>'Research','status'=>'In Process','target'=>'27','limit'=>'24','reviewer'=>'Nina Patel'],
        ['id'=>34,'header'=>'Accessibility Compliance','type'=>'Legal','status'=>'Done','target'=>'18','limit'=>'21','reviewer'=>'Assign reviewer'],
        ['id'=>35,'header'=>'Performance Metrics','type'=>'Technical content','status'=>'In Process','target'=>'23','limit'=>'26','reviewer'=>'David Kim'],
        ['id'=>36,'header'=>'Disaster Recovery Plan','type'=>'Technical content','status'=>'Done','target'=>'14','limit'=>'17','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>37,'header'=>'Third-party Integrations','type'=>'Technical content','status'=>'In Process','target'=>'25','limit'=>'28','reviewer'=>'Eddie Lake'],
        ['id'=>38,'header'=>'User Feedback Summary','type'=>'Research','status'=>'Done','target'=>'20','limit'=>'15','reviewer'=>'Assign reviewer'],
        ['id'=>39,'header'=>'Localization Strategy','type'=>'Narrative','status'=>'In Process','target'=>'12','limit'=>'19','reviewer'=>'Maria Garcia'],
        ['id'=>40,'header'=>'Mobile Compatibility','type'=>'Technical content','status'=>'Done','target'=>'28','limit'=>'31','reviewer'=>'James Wilson'],
        ['id'=>41,'header'=>'Data Migration Plan','type'=>'Technical content','status'=>'In Process','target'=>'19','limit'=>'22','reviewer'=>'Assign reviewer'],
        ['id'=>42,'header'=>'Quality Assurance Protocols','type'=>'Technical content','status'=>'Done','target'=>'30','limit'=>'33','reviewer'=>'Priya Singh'],
        ['id'=>43,'header'=>'Stakeholder Analysis','type'=>'Research','status'=>'In Process','target'=>'11','limit'=>'14','reviewer'=>'Eddie Lake'],
        ['id'=>44,'header'=>'Environmental Impact Assessment','type'=>'Research','status'=>'Done','target'=>'24','limit'=>'27','reviewer'=>'Assign reviewer'],
        ['id'=>45,'header'=>'Intellectual Property Rights','type'=>'Legal','status'=>'In Process','target'=>'17','limit'=>'20','reviewer'=>'Sarah Johnson'],
        ['id'=>46,'header'=>'Customer Support Framework','type'=>'Narrative','status'=>'Done','target'=>'22','limit'=>'25','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>47,'header'=>'Version Control Strategy','type'=>'Technical content','status'=>'In Process','target'=>'15','limit'=>'18','reviewer'=>'Assign reviewer'],
        ['id'=>48,'header'=>'Continuous Integration Pipeline','type'=>'Technical content','status'=>'Done','target'=>'26','limit'=>'29','reviewer'=>'Michael Chen'],
        ['id'=>49,'header'=>'Regulatory Compliance','type'=>'Legal','status'=>'In Process','target'=>'13','limit'=>'16','reviewer'=>'Assign reviewer'],
        ['id'=>50,'header'=>'User Authentication System','type'=>'Technical content','status'=>'Done','target'=>'28','limit'=>'31','reviewer'=>'Eddie Lake'],
        ['id'=>51,'header'=>'Data Analytics Framework','type'=>'Technical content','status'=>'In Process','target'=>'21','limit'=>'24','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>52,'header'=>'Cloud Infrastructure','type'=>'Technical content','status'=>'Done','target'=>'16','limit'=>'19','reviewer'=>'Assign reviewer'],
        ['id'=>53,'header'=>'Network Security Measures','type'=>'Technical content','status'=>'In Process','target'=>'29','limit'=>'32','reviewer'=>'Lisa Wong'],
        ['id'=>54,'header'=>'Project Timeline','type'=>'Planning','status'=>'Done','target'=>'14','limit'=>'17','reviewer'=>'Eddie Lake'],
        ['id'=>55,'header'=>'Resource Allocation','type'=>'Planning','status'=>'In Process','target'=>'27','limit'=>'30','reviewer'=>'Assign reviewer'],
        ['id'=>56,'header'=>'Team Structure and Roles','type'=>'Planning','status'=>'Done','target'=>'20','limit'=>'23','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>57,'header'=>'Communication Protocols','type'=>'Planning','status'=>'In Process','target'=>'15','limit'=>'18','reviewer'=>'Assign reviewer'],
        ['id'=>58,'header'=>'Success Metrics','type'=>'Planning','status'=>'Done','target'=>'30','limit'=>'33','reviewer'=>'Eddie Lake'],
        ['id'=>59,'header'=>'Internationalization Support','type'=>'Technical content','status'=>'In Process','target'=>'23','limit'=>'26','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>60,'header'=>'Backup and Recovery Procedures','type'=>'Technical content','status'=>'Done','target'=>'18','limit'=>'21','reviewer'=>'Assign reviewer'],
        ['id'=>61,'header'=>'Monitoring and Alerting System','type'=>'Technical content','status'=>'In Process','target'=>'25','limit'=>'28','reviewer'=>'Daniel Park'],
        ['id'=>62,'header'=>'Code Review Guidelines','type'=>'Technical content','status'=>'Done','target'=>'12','limit'=>'15','reviewer'=>'Eddie Lake'],
        ['id'=>63,'header'=>'Documentation Standards','type'=>'Technical content','status'=>'In Process','target'=>'27','limit'=>'30','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>64,'header'=>'Release Management Process','type'=>'Planning','status'=>'Done','target'=>'22','limit'=>'25','reviewer'=>'Assign reviewer'],
        ['id'=>65,'header'=>'Feature Prioritization Matrix','type'=>'Planning','status'=>'In Process','target'=>'19','limit'=>'22','reviewer'=>'Emma Davis'],
        ['id'=>66,'header'=>'Technical Debt Assessment','type'=>'Technical content','status'=>'Done','target'=>'24','limit'=>'27','reviewer'=>'Eddie Lake'],
        ['id'=>67,'header'=>'Capacity Planning','type'=>'Planning','status'=>'In Process','target'=>'21','limit'=>'24','reviewer'=>'Jamik Tashpulatov'],
        ['id'=>68,'header'=>'Service Level Agreements','type'=>'Legal','status'=>'Done','target'=>'26','limit'=>'29','reviewer'=>'Assign reviewer'],
    ];
@endphp

<x-layouts.app title="Dashboard 01">
    <x-ui.sidebar-provider style="--sidebar-width: calc(var(--spacing) * 72); --header-height: calc(var(--spacing) * 12);">
        <x-ui.sidebar collapsible="offcanvas" variant="inset">
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button class="data-[slot=sidebar-menu-button]:p-1.5!" href="#">
                            <x-lucide-command class="size-5!" />
                            <span class="text-base font-semibold">Acme Inc.</span>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                {{-- Nav main --}}
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-content class="flex flex-col gap-2">
                        <x-ui.sidebar-menu>
                            <x-ui.sidebar-menu-item class="flex items-center gap-2">
                                <x-ui.sidebar-menu-button class="bg-primary text-primary-foreground min-w-8 duration-200 ease-linear hover:bg-primary/90 hover:text-primary-foreground active:bg-primary/90 active:text-primary-foreground">
                                    <x-lucide-circle-plus />
                                    <span>Quick Create</span>
                                </x-ui.sidebar-menu-button>
                                <x-ui.button size="icon" variant="outline" class="size-8 group-data-[collapsible=icon]:opacity-0">
                                    <x-lucide-mail />
                                    <span class="sr-only">Inbox</span>
                                </x-ui.button>
                            </x-ui.sidebar-menu-item>
                        </x-ui.sidebar-menu>
                        <x-ui.sidebar-menu>
                            @foreach ($navMain as $item)
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button href="#">
                                        <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                        <span>{{ $item['title'] }}</span>
                                    </x-ui.sidebar-menu-button>
                                </x-ui.sidebar-menu-item>
                            @endforeach
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>

                {{-- Documents --}}
                <x-ui.sidebar-group class="group-data-[collapsible=icon]:hidden">
                    <x-ui.sidebar-group-label>Documents</x-ui.sidebar-group-label>
                    <x-ui.sidebar-menu>
                        @foreach ($documents as $doc)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#">
                                    <x-dynamic-component :component="'lucide-'.$doc['icon']" />
                                    <span>{{ $doc['name'] }}</span>
                                </x-ui.sidebar-menu-button>
                                <x-ui.dropdown-menu>
                                    <x-ui.dropdown-menu-trigger>
                                        <x-ui.sidebar-menu-action :show-on-hover="true" class="data-[state=open]:bg-accent rounded-sm">
                                            <x-lucide-more-horizontal />
                                            <span class="sr-only">More</span>
                                        </x-ui.sidebar-menu-action>
                                    </x-ui.dropdown-menu-trigger>
                                    <x-ui.dropdown-menu-content class="w-24 rounded-lg" side="right" align="start">
                                        <x-ui.dropdown-menu-item><x-lucide-folder /><span>Open</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-item><x-lucide-share-2 /><span>Share</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-separator />
                                        <x-ui.dropdown-menu-item variant="destructive"><x-lucide-trash-2 /><span>Delete</span></x-ui.dropdown-menu-item>
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

                {{-- Nav secondary --}}
                <x-ui.sidebar-group class="mt-auto">
                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>
                            @foreach ($navSecondary as $item)
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button href="#">
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

        <x-ui.sidebar-inset>
            {{-- Site header --}}
            <header class="flex h-16 shrink-0 items-center gap-2 border-b px-4 lg:px-6">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <h1 class="text-base font-medium">Documents</h1>
                <div class="ml-auto flex items-center gap-2">
                    <x-ui.button variant="ghost" size="sm" href="#" class="hidden sm:flex dark:text-foreground">GitHub</x-ui.button>
                </div>
            </header>

            <div class="flex flex-1 flex-col">
                <div class="@container/main flex flex-1 flex-col gap-2">
                    <div class="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                        {{-- Section cards --}}
                        <div class="grid grid-cols-1 gap-4 px-4 *:data-[slot=card]:bg-gradient-to-t *:data-[slot=card]:from-primary/5 *:data-[slot=card]:to-card *:data-[slot=card]:shadow-xs lg:px-6 @xl/main:grid-cols-2 @5xl/main:grid-cols-4 dark:*:data-[slot=card]:bg-card">
                            @foreach ($cards as $card)
                                <x-ui.card class="@container/card">
                                    <x-ui.card-header>
                                        <x-ui.card-description>{{ $card['desc'] }}</x-ui.card-description>
                                        <x-ui.card-title class="text-2xl font-semibold tabular-nums @[250px]/card:text-3xl">{{ $card['value'] }}</x-ui.card-title>
                                        <x-ui.card-action>
                                            <x-ui.badge variant="outline">
                                                <x-dynamic-component :component="$card['up'] ? 'lucide-trending-up' : 'lucide-trending-down'" />
                                                {{ $card['badge'] }}
                                            </x-ui.badge>
                                        </x-ui.card-action>
                                    </x-ui.card-header>
                                    <x-ui.card-footer class="flex-col items-start gap-1.5 text-sm">
                                        <div class="line-clamp-1 flex gap-2 font-medium">
                                            {{ $card['line'] }}
                                            <x-dynamic-component :component="$card['up'] ? 'lucide-trending-up' : 'lucide-trending-down'" class="size-4" />
                                        </div>
                                        <div class="text-muted-foreground">{{ $card['sub'] }}</div>
                                    </x-ui.card-footer>
                                </x-ui.card>
                            @endforeach
                        </div>

                        {{-- Interactive area chart --}}
                        <div class="px-4 lg:px-6">
            <x-ui.card class="@container/card"
                                x-data="{
                                    range: '90d',
                                    chart: null,
                                    all: [{d:'2024-04-01',dk:222,mb:150},{d:'2024-04-02',dk:97,mb:180},{d:'2024-04-03',dk:167,mb:120},{d:'2024-04-04',dk:242,mb:260},{d:'2024-04-05',dk:373,mb:290},{d:'2024-04-06',dk:301,mb:340},{d:'2024-04-07',dk:245,mb:180},{d:'2024-04-08',dk:409,mb:320},{d:'2024-04-09',dk:59,mb:110},{d:'2024-04-10',dk:261,mb:190},{d:'2024-04-11',dk:327,mb:350},{d:'2024-04-12',dk:292,mb:210},{d:'2024-04-13',dk:342,mb:380},{d:'2024-04-14',dk:137,mb:220},{d:'2024-04-15',dk:120,mb:170},{d:'2024-04-16',dk:138,mb:190},{d:'2024-04-17',dk:446,mb:360},{d:'2024-04-18',dk:364,mb:410},{d:'2024-04-19',dk:243,mb:180},{d:'2024-04-20',dk:89,mb:150},{d:'2024-04-21',dk:137,mb:200},{d:'2024-04-22',dk:224,mb:170},{d:'2024-04-23',dk:138,mb:230},{d:'2024-04-24',dk:387,mb:290},{d:'2024-04-25',dk:215,mb:250},{d:'2024-04-26',dk:75,mb:130},{d:'2024-04-27',dk:383,mb:420},{d:'2024-04-28',dk:122,mb:180},{d:'2024-04-29',dk:315,mb:240},{d:'2024-04-30',dk:454,mb:380},{d:'2024-05-01',dk:165,mb:220},{d:'2024-05-02',dk:293,mb:310},{d:'2024-05-03',dk:247,mb:190},{d:'2024-05-04',dk:385,mb:420},{d:'2024-05-05',dk:481,mb:390},{d:'2024-05-06',dk:498,mb:520},{d:'2024-05-07',dk:388,mb:300},{d:'2024-05-08',dk:149,mb:210},{d:'2024-05-09',dk:227,mb:180},{d:'2024-05-10',dk:293,mb:330},{d:'2024-05-11',dk:335,mb:270},{d:'2024-05-12',dk:197,mb:240},{d:'2024-05-13',dk:197,mb:160},{d:'2024-05-14',dk:448,mb:490},{d:'2024-05-15',dk:473,mb:380},{d:'2024-05-16',dk:338,mb:400},{d:'2024-05-17',dk:499,mb:420},{d:'2024-05-18',dk:315,mb:350},{d:'2024-05-19',dk:235,mb:180},{d:'2024-05-20',dk:177,mb:230},{d:'2024-05-21',dk:82,mb:140},{d:'2024-05-22',dk:81,mb:120},{d:'2024-05-23',dk:252,mb:290},{d:'2024-05-24',dk:294,mb:220},{d:'2024-05-25',dk:201,mb:250},{d:'2024-05-26',dk:213,mb:170},{d:'2024-05-27',dk:420,mb:460},{d:'2024-05-28',dk:233,mb:190},{d:'2024-05-29',dk:78,mb:130},{d:'2024-05-30',dk:340,mb:280},{d:'2024-05-31',dk:178,mb:230},{d:'2024-06-01',dk:178,mb:200},{d:'2024-06-02',dk:470,mb:410},{d:'2024-06-03',dk:103,mb:160},{d:'2024-06-04',dk:439,mb:380},{d:'2024-06-05',dk:88,mb:140},{d:'2024-06-06',dk:294,mb:250},{d:'2024-06-07',dk:323,mb:370},{d:'2024-06-08',dk:385,mb:320},{d:'2024-06-09',dk:438,mb:480},{d:'2024-06-10',dk:155,mb:200},{d:'2024-06-11',dk:92,mb:150},{d:'2024-06-12',dk:492,mb:420},{d:'2024-06-13',dk:81,mb:130},{d:'2024-06-14',dk:426,mb:380},{d:'2024-06-15',dk:307,mb:350},{d:'2024-06-16',dk:371,mb:310},{d:'2024-06-17',dk:475,mb:520},{d:'2024-06-18',dk:107,mb:170},{d:'2024-06-19',dk:341,mb:290},{d:'2024-06-20',dk:408,mb:450},{d:'2024-06-21',dk:169,mb:210},{d:'2024-06-22',dk:317,mb:270},{d:'2024-06-23',dk:480,mb:530},{d:'2024-06-24',dk:132,mb:180},{d:'2024-06-25',dk:141,mb:190},{d:'2024-06-26',dk:434,mb:380},{d:'2024-06-27',dk:448,mb:490},{d:'2024-06-28',dk:149,mb:200},{d:'2024-06-29',dk:103,mb:160},{d:'2024-06-30',dk:446,mb:400}],
                                    filtered() {
                                        const days = this.range === '30d' ? 30 : this.range === '7d' ? 7 : 90;
                                        const ref = new Date('2024-06-30');
                                        const start = new Date(ref); start.setDate(start.getDate() - days);
                                        return this.all.filter(p => new Date(p.d) >= start);
                                    },
                                    series() {
                                        const d = this.filtered();
                                        return [
                                            { name: 'Mobile', data: d.map(p => ({ x: new Date(p.d).getTime(), y: p.mb })) },
                                            { name: 'Desktop', data: d.map(p => ({ x: new Date(p.d).getTime(), y: p.dk })) },
                                        ];
                                    },
                                    options() {
                                        return window.Chart.buildChartOptions({
                                            type: 'area', height: 250, series: this.series(),
                                            colors: ['var(--primary)', 'var(--primary)'],
                                            options: {
                                                chart: { stacked: true },
                                                fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.65, opacityTo: 0.05, stops: [5, 95] } },
                                                stroke: { width: 2, curve: 'smooth' },
                                                xaxis: { type: 'datetime', labels: { datetimeUTC: false, format: 'MMM d' }, tickAmount: 6 },
                                                yaxis: { show: false },
                                                legend: { show: false },
                                                tooltip: { x: { format: 'MMM dd' } },
                                                grid: { strokeDashArray: 4, yaxis: { lines: { show: true } }, xaxis: { lines: { show: false } } },
                                            },
                                        });
                                    },
                                    ready: false,
                                    init() {
                                        this.$nextTick(async () => {
                                            const ApexCharts = await window.Chart.load(); this.chart = new ApexCharts(this.$refs.canvas, this.options());
                                            await this.chart.render();
                                            this.ready = true;
                                            window.Chart.observeTheme(() => { if (this.chart && this.ready) try { this.chart.updateOptions(this.options(), false, false); } catch (e) {} });
                                        });
                                    },
                                    setRange(r) { this.range = r; if (this.chart && this.ready) this.chart.updateOptions(this.options(), false, false); },
                                }">
                                <x-ui.card-header>
                                    <x-ui.card-title>Total Visitors</x-ui.card-title>
                                    <x-ui.card-description>
                                        <span class="hidden @[540px]/card:block">Total for the last 3 months</span>
                                        <span class="@[540px]/card:hidden">Last 3 months</span>
                                    </x-ui.card-description>
                                    <x-ui.card-action>
                                        <div role="group" class="group/toggle-group hidden w-fit items-center rounded-md shadow-xs @[767px]/card:flex">
                                            @foreach (['90d' => 'Last 3 months', '30d' => 'Last 30 days', '7d' => 'Last 7 days'] as $val => $label)
                                                <button type="button" x-on:click="setRange('{{ $val }}')" ::data-state="range === '{{ $val }}' ? 'on' : 'off'"
                                                    class="border-input data-[state=on]:bg-accent data-[state=on]:text-accent-foreground hover:bg-accent hover:text-accent-foreground inline-flex h-8 min-w-0 flex-1 shrink-0 items-center justify-center gap-2 rounded-none border border-l-0 px-4 text-sm font-medium whitespace-nowrap transition-[color,box-shadow] first:rounded-l-md first:border-l last:rounded-r-md focus-visible:z-10 focus-visible:outline-none">{{ $label }}</button>
                                            @endforeach
                                        </div>
                                    </x-ui.card-action>
                                </x-ui.card-header>
                                <x-ui.card-content class="px-2 pt-4 sm:px-6 sm:pt-6">
                                    <div x-ref="canvas" class="aspect-auto h-[250px] w-full"></div>
                                </x-ui.card-content>
                            </x-ui.card>
                        </div>

                        {{-- Data table --}}
                        <div x-data="{
                                rows: {{ \Illuminate\Support\Js::from($tableData) }},
                                page: 0,
                                pageSize: 10,
                                selected: {},
                                get pageCount() { return Math.max(1, Math.ceil(this.rows.length / this.pageSize)); },
                                get paged() { const s = this.page * this.pageSize; return this.rows.slice(s, s + this.pageSize); },
                                get selectedCount() { return Object.values(this.selected).filter(Boolean).length; },
                                get allPageSelected() { return this.paged.length > 0 && this.paged.every(r => this.selected[r.id]); },
                                toggleAll(v) { this.paged.forEach(r => this.selected[r.id] = v); },
                            }">
                            <x-ui.tabs value="outline" class="w-full flex-col justify-start gap-6">
                                <div class="flex items-center justify-between px-4 lg:px-6">
                                    <x-ui.label for="view-selector" class="sr-only">View</x-ui.label>
                                    <x-ui.tabs-list class="hidden **:data-[slot=badge]:size-5 **:data-[slot=badge]:rounded-full **:data-[slot=badge]:bg-muted-foreground/30 **:data-[slot=badge]:px-1 @4xl/main:flex">
                                        <x-ui.tabs-trigger value="outline">Outline</x-ui.tabs-trigger>
                                        <x-ui.tabs-trigger value="past-performance">Past Performance <x-ui.badge variant="secondary">3</x-ui.badge></x-ui.tabs-trigger>
                                        <x-ui.tabs-trigger value="key-personnel">Key Personnel <x-ui.badge variant="secondary">2</x-ui.badge></x-ui.tabs-trigger>
                                        <x-ui.tabs-trigger value="focus-documents">Focus Documents</x-ui.tabs-trigger>
                                    </x-ui.tabs-list>
                                    <div class="flex items-center gap-2">
                                        <x-ui.dropdown-menu>
                                            <x-ui.dropdown-menu-trigger>
                                                <x-ui.button variant="outline" size="sm">
                                                    <x-lucide-columns-3 />
                                                    <span class="hidden lg:inline">Customize Columns</span>
                                                    <span class="lg:hidden">Columns</span>
                                                    <x-lucide-chevron-down />
                                                </x-ui.button>
                                            </x-ui.dropdown-menu-trigger>
                                            <x-ui.dropdown-menu-content align="end" class="w-56">
                                                <x-ui.dropdown-menu-checkbox-item :checked="true" class="capitalize">header</x-ui.dropdown-menu-checkbox-item>
                                                <x-ui.dropdown-menu-checkbox-item :checked="true" class="capitalize">type</x-ui.dropdown-menu-checkbox-item>
                                                <x-ui.dropdown-menu-checkbox-item :checked="true" class="capitalize">status</x-ui.dropdown-menu-checkbox-item>
                                                <x-ui.dropdown-menu-checkbox-item :checked="true" class="capitalize">target</x-ui.dropdown-menu-checkbox-item>
                                                <x-ui.dropdown-menu-checkbox-item :checked="true" class="capitalize">limit</x-ui.dropdown-menu-checkbox-item>
                                                <x-ui.dropdown-menu-checkbox-item :checked="true" class="capitalize">reviewer</x-ui.dropdown-menu-checkbox-item>
                                            </x-ui.dropdown-menu-content>
                                        </x-ui.dropdown-menu>
                                        <x-ui.button variant="outline" size="sm">
                                            <x-lucide-plus />
                                            <span class="hidden lg:inline">Add Section</span>
                                        </x-ui.button>
                                    </div>
                                </div>

                                <x-ui.tabs-content value="outline" class="relative flex flex-col gap-4 overflow-auto px-4 lg:px-6">
                                    <div class="overflow-hidden rounded-lg border">
                                        <x-ui.table>
                                            <x-ui.table-header class="bg-muted sticky top-0 z-10">
                                                <x-ui.table-row>
                                                    <x-ui.table-head class="w-8"></x-ui.table-head>
                                                    <x-ui.table-head>
                                                        <div class="flex items-center justify-center">
                                                            <button type="button" role="checkbox" x-on:click="toggleAll(!allPageSelected)" :data-state="allPageSelected ? 'checked' : 'unchecked'" :aria-checked="allPageSelected" class="peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground data-[state=checked]:border-primary size-4 shrink-0 rounded-[4px] border shadow-xs flex items-center justify-center">
                                                                <span x-show="allPageSelected" x-cloak><x-lucide-check class="size-3.5" /></span>
                                                            </button>
                                                        </div>
                                                    </x-ui.table-head>
                                                    <x-ui.table-head>Header</x-ui.table-head>
                                                    <x-ui.table-head>Section Type</x-ui.table-head>
                                                    <x-ui.table-head>Status</x-ui.table-head>
                                                    <x-ui.table-head><div class="w-full text-right">Target</div></x-ui.table-head>
                                                    <x-ui.table-head><div class="w-full text-right">Limit</div></x-ui.table-head>
                                                    <x-ui.table-head>Reviewer</x-ui.table-head>
                                                    <x-ui.table-head></x-ui.table-head>
                                                </x-ui.table-row>
                                            </x-ui.table-header>
                                            <x-ui.table-body>
                                                <template x-for="row in paged" :key="row.id">
                                                    <x-ui.table-row ::data-state="selected[row.id] ? 'selected' : ''">
                                                        <x-ui.table-cell>
                                                            <button type="button" class="text-muted-foreground hover:bg-transparent inline-flex size-7 items-center justify-center rounded-md">
                                                                <x-lucide-grip-vertical class="size-3" />
                                                                <span class="sr-only">Drag to reorder</span>
                                                            </button>
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <div class="flex items-center justify-center">
                                                                <button type="button" role="checkbox" x-on:click="selected[row.id] = !selected[row.id]" :data-state="selected[row.id] ? 'checked' : 'unchecked'" :aria-checked="!!selected[row.id]" class="peer border-input dark:bg-input/30 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground data-[state=checked]:border-primary size-4 shrink-0 rounded-[4px] border shadow-xs flex items-center justify-center">
                                                                    <span x-show="selected[row.id]" x-cloak><x-lucide-check class="size-3.5" /></span>
                                                                </button>
                                                            </div>
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <button type="button" class="text-foreground w-fit px-0 text-left underline-offset-4 hover:underline" x-text="row.header"></button>
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <div class="w-32">
                                                                <x-ui.badge variant="outline" class="text-muted-foreground px-1.5"><span x-text="row.type"></span></x-ui.badge>
                                                            </div>
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <x-ui.badge variant="outline" class="text-muted-foreground px-1.5">
                                                                <span x-show="row.status === 'Done'" class="text-green-500 dark:text-green-400 flex"><x-lucide-circle-check /></span>
                                                                <span x-show="row.status !== 'Done'" class="flex"><x-lucide-loader /></span>
                                                                <span x-text="row.status"></span>
                                                            </x-ui.badge>
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <label class="sr-only">Target</label>
                                                            <input :value="row.target" class="dark:bg-transparent dark:hover:bg-input/30 hover:bg-input/30 focus-visible:border focus-visible:bg-background h-8 w-16 rounded-md border-transparent bg-transparent text-right shadow-none" />
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <label class="sr-only">Limit</label>
                                                            <input :value="row.limit" class="dark:bg-transparent dark:hover:bg-input/30 hover:bg-input/30 focus-visible:border focus-visible:bg-background h-8 w-16 rounded-md border-transparent bg-transparent text-right shadow-none" />
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <span x-show="row.reviewer !== 'Assign reviewer'" x-text="row.reviewer"></span>
                                                            <span x-show="row.reviewer === 'Assign reviewer'" class="text-muted-foreground">Assign reviewer</span>
                                                        </x-ui.table-cell>
                                                        <x-ui.table-cell>
                                                            <x-ui.dropdown-menu>
                                                                <x-ui.dropdown-menu-trigger>
                                                                    <x-ui.button variant="ghost" size="icon" class="text-muted-foreground data-[state=open]:bg-muted flex size-8">
                                                                        <x-lucide-ellipsis-vertical />
                                                                        <span class="sr-only">Open menu</span>
                                                                    </x-ui.button>
                                                                </x-ui.dropdown-menu-trigger>
                                                                <x-ui.dropdown-menu-content align="end" class="w-32">
                                                                    <x-ui.dropdown-menu-item>Edit</x-ui.dropdown-menu-item>
                                                                    <x-ui.dropdown-menu-item>Make a copy</x-ui.dropdown-menu-item>
                                                                    <x-ui.dropdown-menu-item>Favorite</x-ui.dropdown-menu-item>
                                                                    <x-ui.dropdown-menu-separator />
                                                                    <x-ui.dropdown-menu-item variant="destructive">Delete</x-ui.dropdown-menu-item>
                                                                </x-ui.dropdown-menu-content>
                                                            </x-ui.dropdown-menu>
                                                        </x-ui.table-cell>
                                                    </x-ui.table-row>
                                                </template>
                                            </x-ui.table-body>
                                        </x-ui.table>
                                    </div>

                                    <div class="flex items-center justify-between px-4">
                                        <div class="text-muted-foreground hidden flex-1 text-sm lg:flex">
                                            <span x-text="selectedCount"></span>&nbsp;of&nbsp;<span x-text="rows.length"></span>&nbsp;row(s) selected.
                                        </div>
                                        <div class="flex w-full items-center gap-8 lg:w-fit">
                                            <div class="hidden items-center gap-2 lg:flex">
                                                <span class="text-sm font-medium">Rows per page</span>
                                                <x-ui.select value="10">
                                                    <x-ui.select-trigger size="sm" class="w-20">
                                                        <x-ui.select-value placeholder="10" />
                                                    </x-ui.select-trigger>
                                                    <x-ui.select-content side="top">
                                                        <x-ui.select-item value="10">10</x-ui.select-item>
                                                        <x-ui.select-item value="20">20</x-ui.select-item>
                                                        <x-ui.select-item value="30">30</x-ui.select-item>
                                                        <x-ui.select-item value="40">40</x-ui.select-item>
                                                        <x-ui.select-item value="50">50</x-ui.select-item>
                                                    </x-ui.select-content>
                                                </x-ui.select>
                                            </div>
                                            <div class="flex w-fit items-center justify-center text-sm font-medium">
                                                Page <span class="mx-1" x-text="page + 1"></span> of <span class="ml-1" x-text="pageCount"></span>
                                            </div>
                                            <div class="ml-auto flex items-center gap-2 lg:ml-0">
                                                <x-ui.button variant="outline" class="hidden size-8 p-0 lg:flex" x-on:click="page = 0" ::disabled="page === 0">
                                                    <span class="sr-only">Go to first page</span>
                                                    <x-lucide-chevrons-left />
                                                </x-ui.button>
                                                <x-ui.button variant="outline" size="icon" class="size-8" x-on:click="if (page > 0) page--" ::disabled="page === 0">
                                                    <span class="sr-only">Go to previous page</span>
                                                    <x-lucide-chevron-left />
                                                </x-ui.button>
                                                <x-ui.button variant="outline" size="icon" class="size-8" x-on:click="if (page < pageCount - 1) page++" ::disabled="page === pageCount - 1">
                                                    <span class="sr-only">Go to next page</span>
                                                    <x-lucide-chevron-right />
                                                </x-ui.button>
                                                <x-ui.button variant="outline" size="icon" class="hidden size-8 lg:flex" x-on:click="page = pageCount - 1" ::disabled="page === pageCount - 1">
                                                    <span class="sr-only">Go to last page</span>
                                                    <x-lucide-chevrons-right />
                                                </x-ui.button>
                                            </div>
                                        </div>
                                    </div>
                                </x-ui.tabs-content>

                                <x-ui.tabs-content value="past-performance" class="flex flex-col px-4 lg:px-6">
                                    <div class="aspect-video w-full flex-1 rounded-lg border border-dashed"></div>
                                </x-ui.tabs-content>
                                <x-ui.tabs-content value="key-personnel" class="flex flex-col px-4 lg:px-6">
                                    <div class="aspect-video w-full flex-1 rounded-lg border border-dashed"></div>
                                </x-ui.tabs-content>
                                <x-ui.tabs-content value="focus-documents" class="flex flex-col px-4 lg:px-6">
                                    <div class="aspect-video w-full flex-1 rounded-lg border border-dashed"></div>
                                </x-ui.tabs-content>
                            </x-ui.tabs>
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
