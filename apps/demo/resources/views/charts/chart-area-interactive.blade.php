<x-layouts.app title="Chart Area Interactive">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-2xl">
            <x-ui.card class="pt-0"
                x-data="{
                    range: '90d',
                    chart: null,
                    ready: false,
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
                            colors: ['var(--chart-2)', 'var(--chart-1)'],
                            options: {
                                chart: { stacked: true },
                                fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.8, opacityTo: 0.1, stops: [5, 95] } },
                                stroke: { width: 2, curve: 'smooth' },
                                xaxis: { type: 'datetime', labels: { datetimeUTC: false, format: 'MMM d' }, tickAmount: 6 },
                                yaxis: { show: false },
                                legend: { show: true, position: 'bottom' },
                                tooltip: { x: { format: 'MMM dd' } },
                            },
                        });
                    },
                    init() {
                        this.$nextTick(async () => {
                            const ApexCharts = await window.Chart.load(); this.chart = new ApexCharts(this.$refs.canvas, this.options());
                            await this.chart.render();
                            this.ready = true;
                            window.Chart.observeTheme(() => { if (this.chart && this.ready) try { this.chart.updateOptions(this.options(), false, false); } catch (e) {} });
                        });
                    },
                    setRange(r) { this.range = r; if (this.chart && this.ready) this.chart.updateOptions(this.options(), false, false); },
                }"
                x-on:range-change.window="setRange($event.detail)">
                <x-ui.card-header class="flex items-center gap-2 space-y-0 border-b py-5 sm:flex-row">
                    <div class="grid flex-1 gap-1">
                        <x-ui.card-title>Area Chart - Interactive</x-ui.card-title>
                        <x-ui.card-description>Showing total visitors for the last 3 months</x-ui.card-description>
                    </div>
                    <x-ui.select value="90d">
                        <span x-show="false" x-effect="$dispatch('range-change', value)"></span>
                        <x-ui.select-trigger class="hidden w-[160px] rounded-lg sm:ml-auto sm:flex" aria-label="Select a value">
                            <x-ui.select-value placeholder="Last 3 months" />
                        </x-ui.select-trigger>
                        <x-ui.select-content class="rounded-xl">
                            <x-ui.select-item value="90d" class="rounded-lg">Last 3 months</x-ui.select-item>
                            <x-ui.select-item value="30d" class="rounded-lg">Last 30 days</x-ui.select-item>
                            <x-ui.select-item value="7d" class="rounded-lg">Last 7 days</x-ui.select-item>
                        </x-ui.select-content>
                    </x-ui.select>
                </x-ui.card-header>
                <x-ui.card-content class="px-2 pt-4 sm:px-6 sm:pt-6">
                    <div x-ref="canvas" class="aspect-auto h-[250px] w-full"></div>
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
