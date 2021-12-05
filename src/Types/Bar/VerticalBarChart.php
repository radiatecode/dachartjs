<?php


namespace RadiateCode\DaChart\Types\Bar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;
use RadiateCode\DaChart\Enums\GeneralOption;

class VerticalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    protected function defaultOptions(): array
    {
        return array_merge(GeneralOption::OPTIONS,[
            'scales'     => [
                'x' => [
                    'grid' => [
                        'color' => 'green',
                        'borderColor' => 'red'
                    ],
                    'ticks' => [
                        'beginAtZero' => true,
                        'color' => 'black', // labels color
                        /**
                         * Rotate the labels orientation
                         */
                        'maxRotation' => 0,
                        'minRotation' => 0,
                    ],
                ],
            ],
            'elements'   => [
                'borderWidth' => 2,
            ],
        ]);
    }
}