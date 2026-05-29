<x-layouts.app title="Chart Radial Stacked">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card class="flex flex-col">
                <x-ui.card-header class="items-center pb-0">
                    <x-ui.card-title>Radial Chart - Stacked</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content class="flex flex-1 items-center pb-0">
                    <div class="relative mx-auto aspect-square w-full max-w-[250px]">
                        <x-ui.chart
                            type="radialBar"
                            :series="[100, 45]"
                            :labels="['Desktop', 'Mobile']"
                            :colors="['var(--chart-1)', 'var(--chart-2)']"
                            :options="[
                                'plotOptions' => ['radialBar' => ['hollow' => ['size' => '50%'], 'track' => ['show' => true], 'dataLabels' => ['show' => false]]],
                                'stroke' => ['lineCap' => 'round'],
                                'legend' => ['show' => false],
                                'grid' => ['strokeDashArray' => 0],
                            ]"
                            class="mx-auto aspect-square w-full max-w-[250px]"
                        />
                        <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-foreground text-2xl font-bold">1,830</span>
                            <span class="text-muted-foreground">Visitors</span>
                        </div>
                    </div>
                </x-ui.card-content>
                <x-ui.card-footer class="flex-col gap-2 text-sm">
                    <div class="flex items-center gap-2 leading-none font-medium">Trending up by 5.2% this month <x-lucide-trending-up class="h-4 w-4" /></div>
                    <div class="text-muted-foreground leading-none">Showing total visitors for the last 6 months</div>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
