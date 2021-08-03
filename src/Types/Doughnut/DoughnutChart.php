<?php


namespace RadiateCode\DaChart\Types\Doughnut;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class DoughnutChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::DOUGHNUT_CHART;
    }

}