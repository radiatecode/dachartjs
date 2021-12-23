<?php


namespace RadiateCode\DaChartjs\Types\Line;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class LineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
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