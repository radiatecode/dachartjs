<?php


namespace DaCode\DaChart\Types\Doughnut;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class DoughnutChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::DOUGHNUT_CHART;
    }

}