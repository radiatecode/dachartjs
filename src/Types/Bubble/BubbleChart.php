<?php


namespace DaCode\DaChart\Types\Bubble;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class BubbleChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BUBBLE_CHART;
    }

}