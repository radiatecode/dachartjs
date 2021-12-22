<?php


namespace RadiateCode\DaChartjs\Types\Bar;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

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
     * @return array|string
     */
    protected function defaultOptions()
    {
        return array_merge(GeneralOption::OPTIONS,[
            'indexAxis' => 'y',
            'elements' => [
                'borderWidth' => 2
            ],
            'scales'     => [
                'y' => [
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
        ]);
    }
}