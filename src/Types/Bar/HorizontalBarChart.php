<?php


namespace RadiateCode\DaChart\Types\Bar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class HorizontalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
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