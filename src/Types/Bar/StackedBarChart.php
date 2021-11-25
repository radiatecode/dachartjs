<?php


namespace RadiateCode\DaChart\Types\Bar;

use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;
use RadiateCode\DaChart\Enums\GeneralOption;

class StackedBarChart extends BaseChartType
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
            'scales' => [
                'x' => [
                    'stacked' => true
                ],
                'y' => [
                    'stacked' => true
                ]
            ]
        ]);
    }
}