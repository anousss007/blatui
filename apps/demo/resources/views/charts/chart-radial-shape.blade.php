<x-layouts.app title="Chart Radial Shape">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card class="flex flex-col">
                <x-ui.card-header class="items-center pb-0">
                    <x-ui.card-title>Radial Chart - Shape</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content class="flex-1 pb-0">
                    <div class="relative mx-auto aspect-square max-h-[250px]">
                        <x-ui.chart
                            type="radialBar"
                            :series="[100]"
                            :labels="['Visitors']"
                            :colors="['var(--chart-2)']"
                            :options="[
                                'plotOptions' => ['radialBar' => ['hollow' => ['size' => '60%'], 'track' => ['show' => true], 'dataLabels' => ['show' => false]]],
                                'stroke' => ['lineCap' => 'round'],
                                'legend' => ['show' => false],
                                'grid' => ['strokeDashArray' => 0],
                            ]"
                            class="mx-auto aspect-square max-h-[250px]"
                        />
                        <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-foreground text-4xl font-bold">1,260</span>
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
