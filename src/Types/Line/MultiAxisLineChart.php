<?php


namespace RadiateCode\DaChart\Types\Line;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class MultiAxisLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    /**
     * ------------------------------------
     * Override the base default options
     * -------------------------------------
     *
     * @return array
     */
    protected function defaultOptions(): array
    {
        return [
            'responsive' => true,
            'interaction' => [
                'intersect' => false,
                'mode' => 'index',
                'axis' => 'x'
            ],
            'stacked' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top'
                ],
                'title' => [
                    'text' => 'My Chart',
                    'position' => 'top',
                    'display' => true,
                    'color' => 'black'
                ]
            ],
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    // grid line settings
                    'grid' => [
                        'drawOnChartArea' => false, // only want the grid lines for one axis to show up
                    ],
                ],
            ]
        ];
    }
}