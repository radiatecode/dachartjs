<?php


namespace RadiateCode\DaChartjs\Types\Radar;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;

class RadarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::RADAR_CHART;
    }

}