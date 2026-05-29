<x-layouts.app title="Chart Line Dots Colors">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Line Chart - Dots Colors</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="line"
                        :config="[
                            'visitors' => ['label' => 'Visitors', 'color' => 'var(--chart-2)'],
                            'chrome' => ['label' => 'Chrome', 'color' => 'var(--chart-1)'],
                            'safari' => ['label' => 'Safari', 'color' => 'var(--chart-2)'],
                            'firefox' => ['label' => 'Firefox', 'color' => 'var(--chart-3)'],
                            'edge' => ['label' => 'Edge', 'color' => 'var(--chart-4)'],
                            'other' => ['label' => 'Other', 'color' => 'var(--chart-5)'],
                        ]"
                        :series="[['name' => 'Visitors', 'data' => [275, 200, 187, 173, 90]]]"
                        :colors="['var(--chart-2)']"
                        :options="[
                            'xaxis' => [
                                'categories' => ['Chrome', 'Safari', 'Firefox', 'Edge', 'Other'],
                            ],
                            'stroke' => ['width' => 2, 'curve' => 'smooth'],
                            'markers' => [
                                'size' => 5,
                                'strokeWidth' => 0,
                                'discrete' => [
                                    ['seriesIndex' => 0, 'dataPointIndex' => 0, 'fillColor' => 'var(--chart-1)', 'strokeColor' => 'var(--chart-1)', 'size' => 5],
                                    ['seriesIndex' => 0, 'dataPointIndex' => 1, 'fillColor' => 'var(--chart-2)', 'strokeColor' => 'var(--chart-2)', 'size' => 5],
                                    ['seriesIndex' => 0, 'dataPointIndex' => 2, 'fillColor' => 'var(--chart-3)', 'strokeColor' => 'var(--chart-3)', 'size' => 5],
                                    ['seriesIndex' => 0, 'dataPointIndex' => 3, 'fillColor' => 'var(--chart-4)', 'strokeColor' => 'var(--chart-4)', 'size' => 5],
                                    ['seriesIndex' => 0, 'dataPointIndex' => 4, 'fillColor' => 'var(--chart-5)', 'strokeColor' => 'var(--chart-5)', 'size' => 5],
                                ],
                            ],
                            'grid' => ['xaxis' => ['lines' => ['show' => false]]],
                            'yaxis' => ['show' => false],
                        ]"
                        class="aspect-auto h-[250px]"
                    />
                </x-ui.card-content>
                <x-ui.card-footer class="flex-col items-start gap-2 text-sm">
                    <div class="flex gap-2 leading-none font-medium">Trending up by 5.2% this month <x-lucide-trending-up class="h-4 w-4" /></div>
                    <div class="text-muted-foreground leading-none">Showing total visitors for the last 6 months</div>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
