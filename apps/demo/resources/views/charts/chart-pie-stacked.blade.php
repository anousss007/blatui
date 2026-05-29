<x-layouts.app title="Chart Pie Stacked">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card class="flex flex-col">
                <x-ui.card-header class="items-center pb-0">
                    <x-ui.card-title>Pie Chart - Stacked</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content class="flex-1 pb-0">
                    {{-- Recharts stacks two concentric pies (desktop inner ring + mobile outer ring). ApexCharts can't render two pies in one chart, so we approximate with a single donut of the primary (desktop) dataset, colored per month. --}}
                    <x-ui.chart
                        type="donut"
                        :series="[186, 305, 237, 173, 209]"
                        :labels="['January', 'February', 'March', 'April', 'May']"
                        :colors="['var(--chart-1)', 'var(--chart-2)', 'var(--chart-3)', 'var(--chart-4)', 'var(--chart-5)']"
                        :options="['legend' => ['show' => false], 'stroke' => ['width' => 0], 'tooltip' => ['enabled' => true], 'dataLabels' => ['enabled' => false], 'plotOptions' => ['pie' => ['donut' => ['size' => '50%', 'labels' => ['show' => false]]]]]"
                        class="mx-auto aspect-square max-h-[250px]"
                    />
                </x-ui.card-content>
                <x-ui.card-footer class="flex-col gap-2 text-sm">
                    <div class="flex items-center gap-2 leading-none font-medium">Trending up by 5.2% this month <x-lucide-trending-up class="h-4 w-4" /></div>
                    <div class="text-muted-foreground leading-none">Showing total visitors for the last 6 months</div>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
