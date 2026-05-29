<x-layouts.app title="Chart Radar Icons">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header class="items-center pb-4">
                    <x-ui.card-title>Radar Chart - Icons</x-ui.card-title>
                    <x-ui.card-description>Showing total visitors for the last 6 months</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="radar"
                        :config="['desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-1)'], 'mobile' => ['label' => 'Mobile', 'color' => 'var(--chart-2)']]"
                        :series="[['name' => 'Desktop', 'data' => [186, 305, 237, 73, 209, 214]], ['name' => 'Mobile', 'data' => [80, 200, 120, 190, 130, 140]]]"
                        :colors="['var(--chart-1)', 'var(--chart-2)']"
                        :options="[
                            'xaxis' => ['categories' => ['January', 'February', 'March', 'April', 'May', 'June']],
                            'yaxis' => ['show' => false],
                            'fill' => ['opacity' => 0.6],
                            'stroke' => ['width' => 2],
                            'markers' => ['size' => 0],
                            'legend' => ['show' => true, 'position' => 'bottom'],
                        ]"
                        class="mx-auto aspect-square max-h-[250px]"
                    />
                </x-ui.card-content>
                <x-ui.card-footer class="flex-col gap-2 pt-4 text-sm">
                    <div class="flex items-center gap-2 leading-none font-medium">Trending up by 5.2% this month <x-lucide-trending-up class="h-4 w-4" /></div>
                    <div class="text-muted-foreground flex items-center gap-2 leading-none">January - June 2024</div>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
