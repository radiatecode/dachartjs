<?php


namespace RadiateCode\DaChart\Types\Line;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class LineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

}