<x-layouts.app title="Chart Bar Custom Label">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Bar Chart - Custom Label</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="bar"
                        :config="['desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-2)']]"
                        :series="[['name' => 'Desktop', 'data' => [186, 305, 237, 73, 209, 214]]]"
                        :colors="['var(--chart-2)']"
                        :options="[
                            'xaxis' => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], 'labels' => ['show' => false], 'axisBorder' => ['show' => false], 'axisTicks' => ['show' => false]],
                            'plotOptions' => ['bar' => ['horizontal' => true, 'borderRadius' => 4]],
                            'yaxis' => ['show' => false],
                            'grid' => ['show' => false],
                            'dataLabels' => [
                                'enabled' => true,
                                'textAnchor' => 'start',
                                'offsetX' => 8,
                                'style' => ['fontSize' => '12px', 'colors' => ['var(--background)']],
                            ],
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
