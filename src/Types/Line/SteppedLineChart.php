<?php


namespace RadiateCode\DaChart\Types\Line;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class SteppedLineChart extends BaseChartType
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
                'mode' => 'point',
                'axis' => 'x'
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