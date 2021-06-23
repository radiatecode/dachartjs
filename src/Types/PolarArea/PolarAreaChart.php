<?php


namespace DaCode\DaChart\Types\PolarArea;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class PolarAreaChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::POLAR_AREA_CHART;
    }

}