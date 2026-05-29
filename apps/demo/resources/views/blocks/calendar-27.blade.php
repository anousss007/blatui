<x-layouts.app title="Calendar 27">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card
            class="@container/card w-full max-w-xl"
            x-data="{
                chart: null,
                ready: false,
                range: { from: '2025-06-05', to: '2025-06-20' },
                all: [
                    { date: '2025-06-01', visitors: 178 }, { date: '2025-06-02', visitors: 470 },
                    { date: '2025-06-03', visitors: 103 }, { date: '2025-06-04', visitors: 439 },
                    { date: '2025-06-05', visitors: 88 },  { date: '2025-06-06', visitors: 294 },
                    { date: '2025-06-07', visitors: 323 }, { date: '2025-06-08', visitors: 385 },
                    { date: '2025-06-09', visitors: 438 }, { date: '2025-06-10', visitors: 155 },
                    { date: '2025-06-11', visitors: 92 },  { date: '2025-06-12', visitors: 492 },
                    { date: '2025-06-13', visitors: 81 },  { date: '2025-06-14', visitors: 426 },
                    { date: '2025-06-15', visitors: 307 }, { date: '2025-06-16', visitors: 371 },
                    { date: '2025-06-17', visitors: 475 }, { date: '2025-06-18', visitors: 107 },
                    { date: '2025-06-19', visitors: 341 }, { date: '2025-06-20', visitors: 408 },
                    { date: '2025-06-21', visitors: 169 }, { date: '2025-06-22', visitors: 317 },
                    { date: '2025-06-23', visitors: 480 }, { date: '2025-06-24', visitors: 132 },
                    { date: '2025-06-25', visitors: 141 }, { date: '2025-06-26', visitors: 434 },
                    { date: '2025-06-27', visitors: 448 }, { date: '2025-06-28', visitors: 149 },
                    { date: '2025-06-29', visitors: 103 }, { date: '2025-06-30', visitors: 446 },
                ],
                get total() { return this.all.reduce((a, c) => a + c.visitors, 0); },
                get label() {
                    if (this.range.from && this.range.to) {
                        return new Date(this.range.from + 'T00:00:00').toLocaleDateString() + ' - ' + new Date(this.range.to + 'T00:00:00').toLocaleDateString();
                    }
                    return 'June 2025';
                },
                filtered() {
                    if (!this.range.from && !this.range.to) return this.all;
                    const from = this.range.from ? new Date(this.range.from + 'T00:00:00') : null;
                    const to = this.range.to ? new Date(this.range.to + 'T00:00:00') : null;
                    return this.all.filter((item) => {
                        const d = new Date(item.date + 'T00:00:00');
                        return (!from || d >= from) && (!to || d <= to);
                    });
                },
                series() {
                    const d = this.filtered();
                    return [{ name: 'Visitors', data: d.map((p) => ({ x: new Date(p.date + 'T00:00:00').getTime(), y: p.visitors })) }];
                },
                options() {
                    return window.Chart.buildChartOptions({
                        type: 'bar', height: 250, series: this.series(),
                        colors: ['var(--primary)'],
                        options: {
                            plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' } },
                            xaxis: { type: 'datetime', labels: { datetimeUTC: false, format: 'd' }, tickAmount: 8 },
                            yaxis: { show: false },
                            legend: { show: false },
                            tooltip: { x: { format: 'MMM dd, yyyy' } },
                            grid: { strokeDashArray: 4, yaxis: { lines: { show: true } }, xaxis: { lines: { show: false } } },
                        },
                    });
                },
                rerender() { if (this.chart && this.ready) try { this.chart.updateOptions(this.options(), false, false); } catch (e) {} },
                init() {
                    this.$nextTick(async () => {
                        const ApexCharts = await window.Chart.load(); this.chart = new ApexCharts(this.$refs.canvas, this.options());
                        await this.chart.render();
                        this.ready = true;
                        window.Chart.observeTheme(() => this.rerender());
                    });
                },
            }"
            @calendar-change="range = $event.detail; rerender()"
        >
            <x-ui.card-header class="@md/card:grid relative flex flex-col border-b">
                <x-ui.card-title>Web Analytics</x-ui.card-title>
                <x-ui.card-description>Showing total visitors for this month.</x-ui.card-description>
                <x-ui.popover class="absolute right-4 top-4">
                    <x-ui.popover-trigger>
                        <x-ui.button variant="outline">
                            <x-lucide-calendar />
                            <span x-text="label"></span>
                        </x-ui.button>
                    </x-ui.popover-trigger>
                    <x-ui.popover-content align="end" class="w-auto overflow-hidden p-0">
                        <x-ui.calendar
                            class="w-full border-0"
                            mode="range"
                            :value="['from' => '2025-06-05', 'to' => '2025-06-20']"
                            default-month="2025-06-05"
                            disable-navigation
                            start-month="2025-06-01"
                            :disabled="['after' => '2025-07-01']"
                        />
                    </x-ui.popover-content>
                </x-ui.popover>
            </x-ui.card-header>
            <x-ui.card-content class="px-4">
                <div class="aspect-auto h-[250px] w-full [&_.apexcharts-tooltip]:!rounded-lg [&_.apexcharts-tooltip]:!border [&_.apexcharts-tooltip]:!border-border [&_.apexcharts-tooltip]:!bg-popover [&_.apexcharts-tooltip]:!text-popover-foreground [&_.apexcharts-tooltip]:!shadow-xl">
                    <div x-ref="canvas" class="w-full"></div>
                </div>
            </x-ui.card-content>
            <x-ui.card-footer class="border-t pt-6">
                <div class="text-sm">
                    You had <span class="font-semibold" x-text="total.toLocaleString()"></span> visitors for the month of June.
                </div>
            </x-ui.card-footer>
        </x-ui.card>
    </div>
</x-layouts.app>
