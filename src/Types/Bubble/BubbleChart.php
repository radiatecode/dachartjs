<?php


namespace RadiateCode\DaChartjs\Types\Bubble;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class BubbleChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::BUBBLE_CHART;
    }

    /**
     * Default Options
     *
     * @return array|string
     */
    protected function defaultOptions()
    {
        return GeneralOption::OPTIONS;
    }
}