<?php


namespace RadiateCode\DaChart\Types\Bubble;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class BubbleChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BUBBLE_CHART;
    }

}