<x-layouts.app title="Chart Tooltip Label Custom">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Tooltip - Custom label</x-ui.card-title>
                    <x-ui.card-description>Tooltip with custom label from chartConfig.</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <x-ui.chart
                        type="bar"
                        :config="['running' => ['label' => 'Running', 'color' => 'var(--chart-1)'], 'swimming' => ['label' => 'Swimming', 'color' => 'var(--chart-2)']]"
                        :series="[['name' => 'Running', 'data' => [450, 380, 520, 140, 600, 480]], ['name' => 'Swimming', 'data' => [300, 420, 120, 550, 350, 400]]]"
                        :colors="['var(--chart-1)', 'var(--chart-2)']"
                        :options="[
                            'chart' => ['stacked' => true],
                            'xaxis' => ['categories' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']],
                            'plotOptions' => ['bar' => ['borderRadius' => 4, 'columnWidth' => '60%']],
                            'yaxis' => ['show' => false],
                            'legend' => ['show' => false],
                        ]"
                        class="aspect-auto h-[250px]"
                    />
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
