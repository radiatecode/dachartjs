<?php


namespace RadiateCode\DaChartjs\Types\Scatter;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class ScatterChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::SCATTER_CHART;
    }

}