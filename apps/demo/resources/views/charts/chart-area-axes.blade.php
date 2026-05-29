<x-layouts.app title="Chart Area Axes">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Area Chart - Axes</x-ui.card-title>
                    <x-ui.card-description>Showing total visitors for the last 6 months</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="area"
                        :config="['mobile' => ['label' => 'Mobile', 'color' => 'var(--chart-2)'], 'desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-1)']]"
                        :series="[['name' => 'Mobile', 'data' => [80, 200, 120, 190, 130, 140]], ['name' => 'Desktop', 'data' => [186, 305, 237, 73, 209, 214]]]"
                        :colors="['var(--chart-2)', 'var(--chart-1)']"
                        :options="[
                            'chart' => ['stacked' => true],
                            'xaxis' => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']],
                            'fill' => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1, 'opacityFrom' => 0.4, 'opacityTo' => 0.1, 'stops' => [0, 100]]],
                            'stroke' => ['width' => 2, 'curve' => 'smooth'],
                            'yaxis' => ['show' => true, 'tickAmount' => 3],
                            'legend' => ['show' => false],
                            'tooltip' => ['x' => ['show' => true]],
                        ]"
                        class="aspect-auto h-[250px]"
                    />
                </x-ui.card-content>
                <x-ui.card-footer>
                    <div class="flex w-full items-start gap-2 text-sm">
                        <div class="grid gap-2">
                            <div class="flex items-center gap-2 leading-none font-medium">
                                Trending up by 5.2% this month <x-lucide-trending-up class="h-4 w-4" />
                            </div>
                            <div class="text-muted-foreground flex items-center gap-2 leading-none">January - June 2024</div>
                        </div>
                    </div>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
