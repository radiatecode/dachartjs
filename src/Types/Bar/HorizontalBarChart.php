<?php


namespace RadiateCode\DaChart\Types\Bar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;
use RadiateCode\DaChart\Enums\GeneralOption;

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