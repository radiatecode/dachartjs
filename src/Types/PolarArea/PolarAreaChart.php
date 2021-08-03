<?php


namespace RadiateCode\DaChart\Types\PolarArea;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class PolarAreaChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::POLAR_AREA_CHART;
    }

}