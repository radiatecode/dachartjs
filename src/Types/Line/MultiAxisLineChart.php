<?php


namespace RadiateCode\DaChartjs\Types\Line;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class MultiAxisLineChart extends BaseChartType
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
        return array_merge(GeneralOption::OPTIONS, [
            'stacked' => false,
            'scales'  => [
                'y'  => [
                    'type'     => 'linear',
                    'display'  => true,
                    'position' => 'left',
                ],
                'y1' => [
                    'type'     => 'linear',
                    'display'  => true,
                    'position' => 'right',
                    // grid line settings
                    'grid'     => [
                        'drawOnChartArea' => false,
                        // only want the grid lines for one axis to show up
                    ],
                ]
            ]
        ]);
    }
}