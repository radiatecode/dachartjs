<?php


namespace DaCode\DaChart\Types\Line;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class LineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

}