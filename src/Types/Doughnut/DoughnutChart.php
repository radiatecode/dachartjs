<?php


namespace RadiateCode\DaChartjs\Types\Doughnut;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class DoughnutChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::DOUGHNUT_CHART;
    }

}