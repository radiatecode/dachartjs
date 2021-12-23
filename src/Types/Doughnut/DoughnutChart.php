<?php


namespace RadiateCode\DaChartjs\Types\Doughnut;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class DoughnutChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::DOUGHNUT_CHART;
    }

    /**
     * Default Options
     *
     * @return array|string
     */
    protected function defaultOptions()
    {
        return GeneralOption::OPTIONS;
    }
}