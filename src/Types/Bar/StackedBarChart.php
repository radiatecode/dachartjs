<?php


namespace RadiateCode\DaChartjs\Types\Bar;

use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class StackedBarChart extends BaseChartType
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