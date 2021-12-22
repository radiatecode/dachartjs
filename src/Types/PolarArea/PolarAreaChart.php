<?php


namespace RadiateCode\DaChartjs\Types\PolarArea;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class PolarAreaChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::POLAR_AREA_CHART;
    }

}