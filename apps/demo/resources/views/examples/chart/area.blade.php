<div class="w-full max-w-lg">
    <x-ui.chart
        type="area"
        :config="['desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-1)']]"
        :series="[['name' => 'Desktop', 'data' => [186, 305, 237, 73, 209, 214]]]"
        :colors="['var(--chart-1)']"
        :options="[
            'xaxis' => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']],
            'fill' => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1, 'opacityFrom' => 0.4, 'opacityTo' => 0.1, 'stops' => [0, 100]]],
            'stroke' => ['width' => 2, 'curve' => 'smooth'],
            'yaxis' => ['show' => false],
        ]"
        class="aspect-auto h-[250px]"
    />
</div>
