<?php


namespace RadiateCode\DaChartjs\Types\Line;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class LineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

}