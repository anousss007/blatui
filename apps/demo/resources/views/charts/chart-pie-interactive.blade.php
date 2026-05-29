<x-layouts.app title="Chart Pie Interactive">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="w-full max-w-md">
            <x-ui.card class="flex flex-col">
                <x-ui.card-header class="flex-row items-start space-y-0 pb-0">
                    <div class="grid gap-1">
                        <x-ui.card-title>Pie Chart - Interactive</x-ui.card-title>
                        <x-ui.card-description>January - June 2024</x-ui.card-description>
                    </div>
                    {{-- Cosmetic month selector. In Recharts this swaps the active slice/center value; here it is presentational only — the donut renders all months with January as the default active month. --}}
                    <x-ui.select value="january" class="ml-auto">
                        <x-ui.select-trigger class="h-7 w-[130px] rounded-lg pl-2.5" aria-label="Select a value">
                            <x-ui.select-value placeholder="Select month" />
                        </x-ui.select-trigger>
                        <x-ui.select-content align="end" class="rounded-xl">
                            <x-ui.select-item value="january" class="rounded-lg [&_span]:flex">
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="flex h-3 w-3 shrink-0 rounded-xs" style="background-color: var(--chart-1)"></span>
                                    January
                                </div>
                            </x-ui.select-item>
                            <x-ui.select-item value="february" class="rounded-lg [&_span]:flex">
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="flex h-3 w-3 shrink-0 rounded-xs" style="background-color: var(--chart-2)"></span>
                                    February
                                </div>
                            </x-ui.select-item>
                            <x-ui.select-item value="march" class="rounded-lg [&_span]:flex">
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="flex h-3 w-3 shrink-0 rounded-xs" style="background-color: var(--chart-3)"></span>
                                    March
                                </div>
                            </x-ui.select-item>
                            <x-ui.select-item value="april" class="rounded-lg [&_span]:flex">
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="flex h-3 w-3 shrink-0 rounded-xs" style="background-color: var(--chart-4)"></span>
                                    April
                                </div>
                            </x-ui.select-item>
                            <x-ui.select-item value="may" class="rounded-lg [&_span]:flex">
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="flex h-3 w-3 shrink-0 rounded-xs" style="background-color: var(--chart-5)"></span>
                                    May
                                </div>
                            </x-ui.select-item>
                        </x-ui.select-content>
                    </x-ui.select>
                </x-ui.card-header>
                <x-ui.card-content class="flex flex-1 justify-center pb-0">
                    <x-ui.chart
                        type="donut"
                        :series="[186, 305, 237, 173, 209]"
                        :labels="['January', 'February', 'March', 'April', 'May']"
                        :colors="['var(--chart-1)', 'var(--chart-2)', 'var(--chart-3)', 'var(--chart-4)', 'var(--chart-5)']"
                        :options="['legend' => ['show' => false], 'stroke' => ['width' => 0], 'tooltip' => ['enabled' => true], 'dataLabels' => ['enabled' => false], 'plotOptions' => ['pie' => ['donut' => ['size' => '60%', 'labels' => ['show' => true, 'name' => ['show' => false], 'value' => ['show' => true], 'total' => ['show' => false, 'label' => 'Visitors']]]]]]"
                        class="mx-auto aspect-square w-full max-w-[300px]"
                    />
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
