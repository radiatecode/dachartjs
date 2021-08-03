<?php


namespace RadiateCode\DaChart\Types\Radar;


use RadiateCode\DaChart\Abstracts\BaseChartType;
use RadiateCode\DaChart\Enums\ChartType;

class RadarChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::RADAR_CHART;
    }

}