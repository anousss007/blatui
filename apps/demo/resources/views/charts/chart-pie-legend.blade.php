<x-layouts.app title="Chart Pie Legend">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card class="flex flex-col">
                <x-ui.card-header class="items-center pb-0">
                    <x-ui.card-title>Pie Chart - Legend</x-ui.card-title>
                    <x-ui.card-description>January - June 2024</x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content class="flex-1 pb-0">
                    <x-ui.chart
                        type="pie"
                        :series="[275, 200, 187, 173, 90]"
                        :labels="['Chrome', 'Safari', 'Firefox', 'Edge', 'Other']"
                        :colors="['var(--chart-1)', 'var(--chart-2)', 'var(--chart-3)', 'var(--chart-4)', 'var(--chart-5)']"
                        :options="['legend' => ['show' => true, 'position' => 'bottom'], 'stroke' => ['width' => 0], 'tooltip' => ['enabled' => true], 'dataLabels' => ['enabled' => false]]"
                        class="mx-auto aspect-square max-h-[300px]"
                    />
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
