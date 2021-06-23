<?php


namespace DaCode\DaChart\Types\Radar;


use DaCode\DaChart\Abstracts\BaseChartType;
use DaCode\DaChart\Enums\ChartType;

class RadarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::RADAR_CHART;
    }

}