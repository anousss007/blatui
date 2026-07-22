<div class="w-full max-w-lg">
    <x-ui.chart
        type="bar"
        :config="['desktop' => ['label' => 'Desktop', 'color' => 'var(--chart-1)']]"
        :series="[['name' => 'Desktop', 'data' => [186, 305, 237, 73, 209, 214]]]"
        :colors="['var(--chart-1)']"
        :options="[
            'xaxis' => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']],
            'plotOptions' => ['bar' => ['borderRadius' => 8, 'columnWidth' => '60%']],
            'yaxis' => ['show' => false],
        ]"
        class="aspect-auto h-[250px]"
    />
</div>
