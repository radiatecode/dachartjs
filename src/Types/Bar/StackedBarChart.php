<?php


namespace DaCode\DaChart\Types\Bar;

use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class StackedBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {

        return [
            'responsive' => true,
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
                'x' => [
                    'stacked' => true
                ],
                'y' => [
                    'stacked' => true
                ]
            ]
        ];
    }
}