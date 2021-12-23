<?php


namespace RadiateCode\DaChartjs\Types\Line;


use RadiateCode\DaChartjs\Abstracts\BaseChartType;
use RadiateCode\DaChartjs\Enums\ChartType;
use RadiateCode\DaChartjs\Enums\GeneralOption;

class SteppedLineChart extends BaseChartType
{
    public function type(): string
    {
        return ChartType::LINE_CHART;
    }

    /**
     * Default options
     *
     * @return array|string
     */
    protected function defaultOptions()
    {
        return array_merge(GeneralOption::OPTIONS, [
            'interaction' => [
                'intersect' => false,
                'mode'      => 'point',
                'axis'      => 'x',
            ],
        ]);
    }
}