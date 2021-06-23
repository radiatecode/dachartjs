<?php


namespace DaCode\DaChart\Types\Scatter;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class ScatterChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::SCATTER_CHART;
    }

}