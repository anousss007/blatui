<?php

// API metadata for the chart component.

return [
    'props' => [
        [
            'name' => 'series',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The data the chart renders, in ApexCharts series format. Each entry is a named data set.',
            'shape' => 'series',
        ],
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'line'",
            'description' => 'The ApexCharts chart type, e.g. line, area, bar, donut, radar. Passed straight through to ApexCharts.',
        ],
        [
            'name' => 'config',
            'type' => 'array',
            'default' => '[]',
            'description' => 'shadcn-style series config keyed by series key. Each value supplies a label and color; the colors derive the chart palette and emit --color-<key> CSS vars for legends.',
            'shape' => 'config',
        ],
        [
            'name' => 'colors',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Explicit fill/stroke colors for the series (CSS colors or var() references). When omitted, colors are derived from config.',
        ],
        [
            'name' => 'options',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Raw ApexCharts options merged into the chart config, e.g. xaxis categories, plotOptions, stroke, fill, yaxis.',
        ],
        [
            'name' => 'labels',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Category labels for chart types that use a flat labels array (e.g. donut, pie, radial). Omitted from the payload when empty.',
        ],
        [
            'name' => 'height',
            'type' => 'int',
            'default' => '250',
            'description' => 'Chart height in pixels. Also sets the canvas min-height.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Chart'",
            'description' => 'Accessible name for the chart container (role="img" aria-label).',
        ],
    ],

    'shapes' => [
        'series' => [
            'label' => 'Each series',
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'description' => 'The series name, shown in tooltips and the legend.',
                ],
                [
                    'name' => 'data',
                    'type' => 'array',
                    'required' => true,
                    'description' => 'The data points for this series — an array of numbers, or [x, y] pairs / { x, y } objects depending on the chart type.',
                ],
            ],
        ],
        'config' => [
            'label' => 'Each config entry',
            'fields' => [
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'Human-readable label for this series key.',
                ],
                [
                    'name' => 'color',
                    'type' => 'string',
                    'description' => 'CSS color for this key (e.g. "var(--chart-1)"). Feeds the derived palette and the --color-<key> CSS var.',
                ],
            ],
        ],
    ],
];
