<?php


namespace RadiateCode\DaChart\Types\Bar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class VerticalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {
        return [
            'responsive' => true,
            'indexAxis'  => 'x',
            'scales'     => [
                'xAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                            'maxRotation' => 45,
                            'minRotation' => 45,
                        ],
                    ],
                ],
            ],
            'elements'   => [
                'borderWidth' => 2,
            ],
            'tooltips'   => [
                'mode'      => 'index',
                'intersect' => false,
            ],
            'plugins'    => [
                'legend' => [
                    'display'  => true,
                    'position' => 'top',
                ],
                'title'  => [
                    'text'     => 'My Chart',
                    'position' => 'top',
                    'display'  => true,
                    'color'    => 'black',
                ],
            ],
        ];
    }
}