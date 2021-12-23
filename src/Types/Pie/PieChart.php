<?php


namespace RadiateCode\DaChartjs\Types\Pie;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class PieChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::PIE_CHART;
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