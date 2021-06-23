<?php


namespace DaCode\DaChart\Types\Bar;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class HorizontalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {
        return [
            'responsive' => true,
            'indexAxis' => 'x',
            'elements' => [
                'borderWidth' => 2
            ],
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
            ]
        ];
    }
}