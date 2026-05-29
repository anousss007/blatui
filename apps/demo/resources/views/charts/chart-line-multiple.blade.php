<x-layouts.app title="Chart Line Multiple">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Line Chart - Multiple</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="line"
                        :config="[
                            'desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-1)'],
                            'mobile' => ['label' => 'Mobile', 'color' => 'var(--chart-2)'],
                        ]"
                        :series="[
                            ['name' => 'Desktop', 'data' => [186, 305, 237, 73, 209, 214]],
                            ['name' => 'Mobile', 'data' => [80, 200, 120, 190, 130, 140]],
                        ]"
                        :colors="['var(--chart-1)', 'var(--chart-2)']"
                        :options="[
                            'xaxis' => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']],
                            'stroke' => ['width' => 2, 'curve' => 'smooth'],
                            'markers' => ['size' => 0],
                            'yaxis' => ['show' => false],
                        ]"
                        class="aspect-auto h-[250px]"
                    />
                </x-ui.card-content>
                <x-ui.card-footer>
                    <div class="flex w-full items-start gap-2 text-sm">
                        <div class="grid gap-2">
                            <div class="flex items-center gap-2 leading-none font-medium">Trending up by 5.2% this month <x-lucide-trending-up class="h-4 w-4" /></div>
                            <div class="text-muted-foreground flex items-center gap-2 leading-none">Showing total visitors for the last 6 months</div>
                        </div>
                    </div>
                </x-ui.card-footer>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
