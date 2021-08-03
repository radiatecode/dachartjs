<?php


namespace RadiateCode\DaChart\Types\Scatter;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class ScatterChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::SCATTER_CHART;
    }

}