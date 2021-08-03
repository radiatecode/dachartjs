<?php


namespace RadiateCode\DaChart\Types\Pie;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class PieChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::PIE_CHART;
    }

}