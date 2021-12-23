<?php


namespace RadiateCode\DaChartjs\Types\PolarArea;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class PolarAreaChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::POLAR_AREA_CHART;
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