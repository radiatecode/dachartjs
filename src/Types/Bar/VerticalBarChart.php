<?php


namespace RadiateCode\DaChart\Types\Bar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class VerticalBarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BAR_CHART;
    }
}