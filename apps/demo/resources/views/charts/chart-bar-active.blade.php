<x-layouts.app title="Chart Bar Active">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Bar Chart - Active</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="bar"
                        :config="[
                            'chrome' => ['label' => 'Chrome', 'color' => 'var(--chart-1)'],
                            'safari' => ['label' => 'Safari', 'color' => 'var(--chart-2)'],
                            'firefox' => ['label' => 'Firefox', 'color' => 'var(--chart-3)'],
                            'edge' => ['label' => 'Edge', 'color' => 'var(--chart-4)'],
                            'other' => ['label' => 'Other', 'color' => 'var(--chart-5)'],
                        ]"
                        :series="[['name' => 'Visitors', 'data' => [187, 200, 275, 173, 90]]]"
                        :colors="['var(--chart-1)', 'var(--chart-2)', 'var(--chart-3)', 'var(--chart-4)', 'var(--chart-5)']"
                        :options="[
                            'xaxis' => ['categories' => ['Chrome', 'Safari', 'Firefox', 'Edge', 'Other']],
                            'plotOptions' => ['bar' => ['borderRadius' => 8, 'columnWidth' => '60%', 'distributed' => true]],
                            'yaxis' => ['show' => false],
                            'legend' => ['show' => false],
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
