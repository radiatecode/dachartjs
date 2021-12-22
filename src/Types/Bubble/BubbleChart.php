<?php


namespace RadiateCode\DaChartjs\Types\Bubble;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class BubbleChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BUBBLE_CHART;
    }

}