<?php


namespace RadiateCode\DaChartjs\Types\Scatter;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class ScatterChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::SCATTER_CHART;
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