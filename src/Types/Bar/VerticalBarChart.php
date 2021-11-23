<?php


namespace RadiateCode\DaChart\Types\Bar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;
use RadiateCode\DaChart\Options\General;

class VerticalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {
        return array_merge(General::OPTIONS,[
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
        ]);
    }
}