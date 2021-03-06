<?php


namespace RadiateCode\DaChartjs\Types\Line;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class InterpolationLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    /**
     * Default options
     *
     * @return array|string
     */
    protected function defaultOptions()
    {
        return array_merge(GeneralOption::OPTIONS,[
            'scales' => [
                'x' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'X axis value'
                    ],
                ],
                'y' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Y axis value'
                    ],
                    'suggestedMin' => -10,
                    'suggestedMax'=> 200
                ],
            ]
        ]);
    }

}