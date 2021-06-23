<?php


namespace DaCode\DaChart\Types\Pie;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class PieChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::PIE_CHART;
    }

}