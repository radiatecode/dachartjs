<?php


namespace RadiateCode\DaChart\Types\Line;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;
use RadiateCode\DaChart\Enums\GeneralOption;

class MultiAxisLineChart extends BaseChartType
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