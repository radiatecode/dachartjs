<?php


namespace RadiateCode\DaChartjs\Types\Pie;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class PieChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::PIE_CHART;
    }

}