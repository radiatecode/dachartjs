<?php


namespace RadiateCode\DaChartjs\Types\Bar;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class VerticalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }

    /**
     * Default options
     *
     * @return array|string
     */
    protected function defaultOptions()
    {
        return array_merge(GeneralOption::OPTIONS,[
            'scales'     => [
                'x' => [
                    'grid' => [
                        'color' => 'green',
                        'borderColor' => 'red'
                    ],
                    'ticks' => [
                        'autoSkip' => false,
                        'beginAtZero' => true,
                        'color' => 'black', // labels color
                        /**
                         * Rotate the labels orientation
                         */
                        'maxRotation' => 45,
                        'minRotation' => 45,
                    ],
                    'gridLines' => [
                        'display' => false
                    ]
                ],
            ],
            'elements'   => [
                'borderWidth' => 2,
            ],
        ]);
    }
}